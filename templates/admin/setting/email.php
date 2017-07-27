	<style>
		body{min-width: 1400px;}
		.top li{
			margin-bottom: 15px;
			margin-right: 4px;
			float: left;
		}
		input[type='radio']{
			position: relative;
			top:2px;
			margin-right: 6px;
			margin-left: 12px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/menu.php')?>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/top-header.php')?>
	<div class="warpper">
		
		<div class="box fl">
			<h1>邮箱设置</h1>
			<table class="table-list setting">
				<tr>
					<th width="190">配置项名称</th>
					<th width="350">配置项值</th>
					<th width="220">调用方法</th>
					<th width="220">操作</th>
				</tr>
			
				{Setting_list}
				<tr data-data='{data}' class='tr'>
					<td>{name}</td>
					<td>{html}</td>
					<td><span class="label">{name_key}</span></td>
					<td><i class="fa fa-trash-o"></i></td>
				</tr>
				{/Setting_list}
			</table>

			<div class="tools" style="margin: 13px 0 0 0;">
				<button class="btn" id="js-create-setting"><i class="fa fa-plus"></i>添加配置项</button>
			</div>
			
		</div>
		
	
		
	</div>
	

	<script type="text/dom">
		var create-setting = <div class="create-setting" api-name="Setting/Create">
			<input type="text" placeholder="请输入配置项名称" name="配置项名称" api-param-name="name" min="2" max="16">
			<select api-param-name="type">
				<option value="input">input</option>
				<!-- <option value="radio">radio</option> -->
				<!-- <option value="checkbox">checkbox</option> -->
			</select>
			<input type="text" api-param-name="valueSplit" name="配置项属性" style="display: none" placeholder="请输入配置项每个属性的值(以逗号分割)">
			
			<input type="text" min="2" max="26" api-param-name="name_key"  name="配置项调用方法" placeholder="请输入调用方法">
		</div>
		var edit-setting = <div class="edit-setting" api-name="Setting/Edit">
			<input type="text" placeholder="请输入配置项名称" name="配置项名称" api-param-name="name" value="{%name%}" min="2" max="16">
			<select api-param-name="type" value="{%type%}">
				<option value="input">input</option>
				<!-- <option value="radio">radio</option> -->
				<!-- <option value="checkbox">checkbox</option> -->
			</select>
			<input type="text" api-param-name="valueSplit" value="{%valueSplit%}" name="配置项属性" style="display: none" placeholder="请输入配置项每个属性的值(以逗号分割)">
			
			<input type="text" min="2" max="26" api-param-name="name_key" value="{%name_key%}"  name="配置项调用方法" placeholder="请输入调用方法">
		</div>
	</script>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/footer.php')?>
	<script type="text/javascript">
		
		var timeout = 0;
		$("input[type='text']").bind("propertychange input" , function(){
			clearTimeout(timeout);
			$this = $(this);
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			timeout = setTimeout(function(){
				ApiRequest.push('Setting/Edit_item' , {
					params : {
						id : data.id,
						value : $this.val()
					},
					success : false ,
					error : false,
				}).then(function(data){
					popup.toast('修改成功')
				} , function(data){
					popup.toast(data.message)
				})
			} , 450);
		});

		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			ApiRequest.push('Setting/Remove' , {params : {id : data.id}})
		})
		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			data.valueSplit = $.parseJSON(data.valueSplit).join(',');
			popup.sure({
				title : '编辑配置项',
				content : dom.get('edit-setting' , data)
			}).then(function(){
				var type = $(".edit-setting [api-param-name='type']").val();
				if(type != 'input' && $('.edit-setting [api-param-name="valueSplit"]').val() == ''){
					popup.toast('您还没有输入配置项属性')
					return false;
				}
				ApiRequest.push('Setting/Edit' , {params : {id : data.id}})
			});

			// 初始化下拉框与分割配置项属性的关系
			var value = $(".edit-setting [api-param-name='type']").val();
			$createSetting = $(".edit-setting [api-param-name='valueSplit']");
			value != 'input' ? $createSetting.show() : $createSetting.hide();

			// 监听下拉框的点击事件
			$(".edit-setting [api-param-name='type']").change(function(){
				var value = $(this).val();
				$createSetting = $(".edit-setting [api-param-name='valueSplit']");
				value != 'input' ? $createSetting.show() : $createSetting.hide();
			})
		});
		$("#js-create-setting").click(function(){
			popup.sure({
				title : '添加配置项目',
				content : dom.get('create-setting')
			}).then(function(){
				var type = $(".create-setting [api-param-name='type']").val();
				if(type != 'input' && $('.create-setting [api-param-name="valueSplit"]').val() == ''){
					popup.toast('您还没有输入配置项属性')
					return false;
				}
				ApiRequest.push('Setting/Create')
			});

			// 监听下拉框的点击事件
			$(".create-setting [api-param-name='type']").change(function(){
				var value = $(this).val();
				$createSetting = $(".create-setting [api-param-name='valueSplit']");
				value != 'input' ? $createSetting.show() : $createSetting.hide();
			})
		})
	</script>

</body>
</html>