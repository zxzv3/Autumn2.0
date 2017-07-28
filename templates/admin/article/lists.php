	<style>
		.edui-container{width: 100%}
	</style>
</head>
<body>
	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn fezocms" onclick="window.location.href='./<?=ADMINDIR?>/article/create'" id="js-create-article"><i class="fa fa-plus"></i>创建文章</button>
			<select id="js-switch" name='class'>
				{Class_list}
				<option value="{id}">{html}{name}</option>
				{/Class_list}
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th><div class="widget-checkbox"></div></th>
				<th>文章标题</th>	 
				<th>文章内容</th>
				<th>所属栏目</th>	 
				<th>创建时间</th>	 
				<th>编辑时间</th>	 
				<th>操作</th>	 
			</tr>
			

			{Article_list}
			<tr data-data='{data}'>
				<td style="width: 10px"><div class="widget-checkbox"></div></td>
				<td style="width: 350px">{title}</td>
				<td style="width: 500px">{content}</td>
				<td>{from_class}</td>
				<td>{create_time}</td>
				<td>{update_time}</td>
				<td>
					<i class="fa fa-edit" data-id="{id}"></i>
					<i class="fa fa-trash-o" data-id="{id}"></i>
				</td>
			</tr>
			{/Article_list}

		</table>
	
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
		$("#js-create-article").click(function(){

		})
	</script>

</body>
</html>