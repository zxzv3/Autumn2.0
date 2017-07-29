	<style>
		body{min-width: 1400px;}
		.top li{
			margin-bottom: 15px;
			margin-right: 4px;
			float: left;
		}
		
		.admin_group_create .checkbox span{position: relative;top:3px;}
		.admin_group_create .limit{border-radius:5px;margin-top:10px;float:left;width:100%;padding:8px 14px;background-color:#f3f3f3;max-height:400px;overflow:hidden;overflow-y:scroll}
		.admin_group_create .limit h2{float:left;width:100%;color:#aaa;font-weight:400;font-size:12px;margin-bottom:14px;margin-top:14px}
		.admin_group_create .limit .widget-checkbox{margin-top:3px;margin-right:5px}
		.admin_group_create .limit label{margin-left:10px;margin-right:15px;margin-bottom:11px;float:left}
		.admin_user_create .class{float:left;width:100%;position:relative}
		.admin_user_create .class button{top:9px;right:8px;font-size:12px;position:absolute}

	</style>
</head>
<body>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/menu.php')?>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn active" id="js-create-group"><i class="fa fa-user-plus"></i>创建权限组</button>
		</div>
		<table class="table-list">
			

			<tr>
				<th width="50"><div class="widget-checkbox"></div></th>
				<th width="150">权限组名称</th>
				<th>权限组功能</th>
				<th width="200">创建时间</th>
				<th width="200">拥有人数</th>
				<th width="150">操作</th>
			</tr>

			{Group_list}
				<tr data-data='{data}'>
					<td><div class="widget-checkbox"></div></td>
					<td><div class="label {group_state} fl">
						{name}
					</div></td>
					<td>{limit_trun}</td>
					<td>{create_time}</td>
					<td>{people}人</td>
					<td>
						<i class="fa fa-edit"></i>
						<i class="fa fa-trash-o"></i>
					</td>
				</tr>
			{/Group_list}
		</table>		
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
		
	</div>	
	
	<script type="text/dom">
		var create_group = <div class="admin_group_create" api-name='Admin_group/Create'>
			<input type="text" placeholder="请输入权限组名称" api-param-name='name' name='权限组名称' min='2' max='16'>
			<div class="limit">
				<?php
					$Jurisdiction = $this->config->item('admin_jurisdiction');
					foreach ($Jurisdiction as $key => $value) {
						echo '<h2>' . $key . '</h2>';
						foreach ($value as $song_key => $song_value) {
							echo '<label class="checkbox" for="' . $song_value . '"><div class="widget-checkbox two2" name="' . $song_value . '" id="' . $song_value . '"></div><span>' . $song_key . '</span></label>';
						}
					}
				?>
			</div>
		</div>
		var edit_group = <div class="admin_group_create" api-name='Admin_group/Edit'>
			<input type="text" placeholder="请输入权限组名称" value="{%name%}" api-param-name='name' name='权限组名称' min='2' max='16'>
			<div class="limit">
				<?php
					$Jurisdiction = $this->config->item('admin_jurisdiction');
					foreach ($Jurisdiction as $key => $value) {
						echo '<h2>' . $key . '</h2>';
						foreach ($value as $song_key => $song_value) {
							echo '<label class="checkbox" for="' . $song_value . '"><div class="widget-checkbox two2" name="' . $song_value . '" id="' . $song_value . '"></div><span>' . $song_key . '</span></label>';
						}
					}
				?>
			</div>
		</div>
	</script>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/footer.php')?>
	<script type="text/javascript">
		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			if(data.limit == 'all'){
				popup.toast('超级管理员权限组拥有至高无上的权利，任何人无权利去删除这个权限组');
				return false;
			}
			popup.sure({
				title : '删除权限组',
				content : '您确定要删除该权限组吗，删除后该权限组下的用户的权限将会被清空',
			}).then(function(){
				ApiRequest.push('Admin_group/Remove' , {params : {id : data.id}});
			})
		});



		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			if(data.limit == 'all'){
				popup.toast('超级管理员权限组拥有至高无上的权利，任何人无权利去编辑这个权限组');
				return false;
			}
			popup.sure({
				title : '编辑权限组',
				content : dom.get('edit_group' , data),
				style:{'width' : 750}
			}).then(function(target){
				var limit = new Array();
				target.popup.find(".limit .widget-checkbox").each(function(index, el) {
					if($(el).is('.active')){
						limit.push($(el).attr('name'))
					}
				});
				ApiRequest.push('Admin_group/Edit' , {params : {
					id : data.id,
					limit : limit
				}})
			})

			$.each($.parseJSON(data.limit) , function(key , value){
				$("#" + value).addClass('active');
			})
		});



		$("#js-create-group").click(function(event) {
			popup.sure({
				title : '创建权限组',
				content : dom.get('create_group'),
				style:{'width' : 750}
			}
			).then(function(target){
				var limit = new Array();
				target.popup.find(".limit .widget-checkbox").each(function(index, el) {
					if($(el).is('.active')){
						limit.push($(el).attr('name'))
					}
				});
				ApiRequest.push('Admin_group/Create' , {params : {limit : limit}})
			})
		});

	</script>
</body>
</html>