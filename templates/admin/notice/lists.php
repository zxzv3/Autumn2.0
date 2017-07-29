	<style>
		.edui-container{width: 100%}
	</style>
</head>
<body>
	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn fezocms" id="js-create-notice"><i class="fa fa-plus"></i>发送消息</button>
			<button class="btn fezocms" id="js-create-letter"><i class="fa fa-plus"></i>发送私信</button>
			<select id="js-switch" name='type'>
				<option value="letter">私信</option>
				<option value="notice">通知</option>
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th><div class="widget-checkbox"></div></th>
				<th>消息标题</th>	 
				<th>消息内容</th>	 
				<th>消息类型</th>	 
				<th>创建时间</th>	 
				<th>所属人</th>	 
				<th>操作</th>	 
			</tr>
			

			{Notice_list}
			<tr data-data='{data}'>
				<td style="width: 10px"><div class="widget-checkbox"></div></td>
				<td style="width: 350px">{title}</td>
				<td style="width: 500px">{content}</td>
				<td>{type}</td>
				<td>{create_time}</td>
				<td>{from_user}</td>
				<td>
					<i class="fa fa-edit" data-id="{id}"></i>
					<i class="fa fa-trash-o" data-id="{id}"></i>
				</td>
			</tr>
			{/Notice_list}

		</table>
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
	
	</div>

	
	<script type="text/dom">
		var create-notice = <div class="create-notice" api-name='Notice/Create'>
			<input type="text" api-param-name='title' placeholder="请输入通知的标题" max="50" min="2">
			<div id="Umediter" api-param-name='content' style="width:100%;height:340px;"></div>
		</div>
		var edit-notice = <div class="edit-notice" api-name='Notice/Edit'>
			<input type="text" api-param-name='title' value="{%title%}" placeholder="请输入通知的标题" max="50" min="2">
			<div id="Umediter" api-param-name='content' style="width:100%;height:340px;">{%content%}</div>
		</div>

		var create-letter = <div class="create-letter" api-name='Notice/Create'>
			<input type="text" api-param-name='from_user' placeholder="请输入接收私信的用户ID" max="50" min="1">
			<input type="text" api-param-name='title' placeholder="请输入私信的标题" max="50" min="2">
			<div id="Umediter" api-param-name='content' style="width:100%;height:340px;"></div>
		</div>
		var edit-letter = <div class="edit-letter" api-name='Notice/Edit'>
			<input type="text" api-param-name='title' value="{%title%}" placeholder="请输入私信的标题" max="50" min="2">
			<div id="Umediter" api-param-name='content' style="width:100%;height:340px;">{%content%}</div>
		</div>
	</script>



	<?php $this->load->view(ADMINDIR . '/template/footer.php')?>


	<!-- load umeditor -->
    <link href="./assets/bin/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script src="./assets/bin/umeditor/third-party/jquery.min.js"></script>
    <script src="./assets/bin/umeditor/third-party/template.min.js"></script>
    <script src="./assets/bin/umeditor/umeditor.config.js"></script>
    <script src="./assets/bin/umeditor/umeditor.min.js"></script>
    <script src="./assets/bin/umeditor/lang/zh-cn/zh-cn.js"></script>
	<!-- load umeditor -->

	<script type="text/javascript">

		var um;
		$('#js-create-notice').click(function(){
			popup.sure({
				title : '发送通知',
				style : {width : 900},
				content : dom.get('create-notice')
			}).then(function(){
				ApiRequest.push('Notice/Create' , {params : {
					content : um.getContent(),
					type : 'notice',
					from_user : -1
				}})
			})
			UM.delEditor('Umediter');
   	 		um = UM.getEditor('Umediter');
		})



		$('#js-create-letter').click(function(){
			popup.sure({
				title : '发送私信',
				style : {width : 900},
				content : dom.get('create-letter')
			}).then(function(){
				ApiRequest.push('Notice/Create' , {params : {
					content : um.getContent(),
					type : 'letter',
				}})
			})
			UM.delEditor('Umediter');
   	 		um = UM.getEditor('Umediter');
		})




		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除数据',
				content : "您确定要删除当前的数据吗，确认后与该相关的数据的所有的数据也将会同时间被删除。"
			}).then(function(){
				ApiRequest.push('Notice/Remove' , {params : {id : data.id}})
			})
		});


		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			ApiRequest.push('Notice/GetContent' , {
				params : {id : data.id},
				success : '' , error : ''
			}).then(function(datas){
				data.content = datas.message;
				popup.sure({
					title : '修改内容',
					style : {width : 900},
					content : dom.get('edit-notice' , data)
				} , {
				}).then(function(){
					ApiRequest.push('Notice/Edit' , {
						params : {
							id : data.id,
							content : um.getContent()
						}
					})
				})
				UM.delEditor('Umediter');
	   	 		um = UM.getEditor('Umediter');
			}, function(error){
				popup.toast(error.message)
			})
		});


	</script>
</body>
</html>