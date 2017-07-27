	<style>
		.edui-container{width: 100%}
	</style>
</head>
<body>
	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn fezocms" id="js-create-notice"><i class="fa fa-plus"></i>发送通知</button>
			<button class="btn fezocms" id="js-create-letter"><i class="fa fa-plus"></i>发送私信</button>
			<select name="" id="">
				<option value="">私信</option>
				<option value="">通知</option>
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th><input type="checkbox"></th>
				<th>消息标题</th>	 
				<th>消息内容</th>	 
				<th>消息类型</th>	 
				<th>创建时间</th>	 
				<th>所属人</th>	 
				<th>操作</th>	 
			</tr>
			

			{Notice_list}
			<tr data-data='{data}'>
				<td style="width: 10px"><input type="checkbox"></td>
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
	
	</div>

	
	<script type="text/dom">
		var create-notice = <div class="create-notice" api-name='Notice/Create'>
			<input type="text" api-param-name='title' placeholder="请输入通知的标题" max="50" min="2">
			<div id="myEditor" api-param-name='content' style="float:left;width:100%;height:340px;"></div>
		</div>
		var edit-notice = <div class="edit-notice" api-name='Notice/Edit'>
			<input type="text" api-param-name='title' value="{%title%}" placeholder="请输入通知的标题" max="50" min="2">
			<div id="myEditor" api-param-name='content' style="float:left;width:100%;height:340px;">{%content%}</div>
		</div>


	</script>
	<script type="text/javascript">
		function ApiRequestSuccess(){}

		function ApiRequestError(){}
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

	<link rel="stylesheet" type="text/css" href="./assets/bin/jedate/skin/jedate.css">
	<script src="./assets/bin/jedate/jedate.js"></script>
	<script type="text/javascript">
	

		$('#js-create-notice').click(function(){
			var um;
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
   	 		um = UM.getEditor('myEditor');
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
			var um;
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			ApiRequest.push('Notice/GetContent' , {params : {id : data.id}} , {
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
						content : um.getContent(),
					})
				})
	   	 		um = UM.getEditor('myEditor');
			}, function(error){
				popup.toast(error.message)
			})
		});


	</script>
</body>
</html>