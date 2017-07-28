	<style>
		.edui-container{width: 100%}
		.box h1{margin:8px 0 30px 9px!important;float: left;}
		.box .class{color:#777;padding-left:12px;border:none;float: left;cursor: pointer;outline: none;border-bottom: 1px solid #f2f2f2;height: 45px;}
		.box input[type='text']{float:left;width: 100%;padding:14px;border:none;border-bottom:1px solid #f2f2f2;}
		.box .item{float:left;width:100%;margin-bottom: 10px;}
		.box textarea{width: 100%;height: 140px;border:none;border-bottom:1px solid #f2f2f2;outline: none;padding:13px;}

		.box .left{min-width:900px;float: left;width: 50%;}
		.box .right{float: left;width: 50%;}
		#js-save{margin-right: 0}
	</style>
</head>
<body>
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		
		<div class="box" api-name='Article/Create'>
			<div class="left">
				<h1>创建新文章</h1>
				<div class="item">
					<select class="class" style="width: 135px" class="fl" api-param-name="class">
					{Class_list}
						<option value="{id}">{html}{name}</option>
					{/Class_list}
					</select>
					<input type="text" style="width: 80%;" api-param-name="title" max="50" min="1" placeholder="请输入文章的标题">
				</div>
				<div class="item">
					<input type="text" api-param-name="keywords" max="100" min="1" placeholder="请输入文章的关键词，以逗号分隔开">
				</div>
				<div class="item">
					<textarea  api-param-name="description" maxlength="500" min="1" placeholder="请输入文章的描述"></textarea>
				</div>
				
				<div class="tools">
					<button class="btn blue-o fr" id="js-save"><i class="fa fa-save"></i>保存文章</button>
					<button class="btn"><i class="fa fa-upload"></i>上传封面图片</button>
				</div>
				<div id="Umediter" api-param-name='content' style="width:100%;height:540px;"></div>
			</div>
			<div class="right">
			</div>
		</div>

	</div>




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
		UM.delEditor('Umediter');
 		um = UM.getEditor('Umediter');
 		$("#js-save").click(function(){
 			ApiRequest.push('Article/Create' , {params : {content : um.getContent()}})
 		});
	</script>

</body>
</html>