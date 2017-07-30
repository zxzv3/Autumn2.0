	<style>
		.edui-container{width: 100%}
		.box h1{margin:8px 0 30px 9px!important;float: left;}
		.box .class{color:#777;padding-left:12px;border:none;float: left;cursor: pointer;outline: none;border-bottom: 1px solid #f2f2f2;height: 45px;}
		.box input[type='text']{float:left;width: 100%;padding:14px;border:none;border-bottom:1px solid #f2f2f2;}
		.box .item{float:left;width:100%;margin-bottom: 10px;}
		.box textarea{width: 100%;height: 140px;border:none;border-bottom:1px solid #f2f2f2;outline: none;padding:13px;}

		.box .left{min-width:900px;float: left;width: 50%;}
		.box .right{float: left;width: 40%;text-align: center;}
		.box .right img{width: 70%;margin:0 auto;margin-top:30px;}
		#js-save{margin-right: 0}

		.fileQueued{
			float: left;
			width: 200px;
			margin-left: 10px;
			display: none;
			margin-top:4px;
		}
		.fileQueued img{float: left;border-radius: 100%}
		.fileQueued span{font-size:12px;margin-left:10px;margin-top:8px;float: left;}
	</style>
</head>
<body>
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		
		<div class="box" api-name='Article/Edit'>
			<div class="left">
				<h1>创建新文章</h1>
				<div class="item">
					<select class="class" value="<?=$from_class?>" style="width: 135px" class="fl" api-param-name="class">
					{Class_list}
						<option value="{id}">{html}{name}</option>
					{/Class_list}
					</select>
					<input type="text" style="width: 80%;" api-param-name="title" max="50" min="1" placeholder="请输入文章的标题" value="<?=$title?>">
				</div>
				<div class="item">
					<input type="text" api-param-name="keywords" max="100" min="1" placeholder="请输入文章的关键词，以逗号分隔开" value="<?=$keywords?>">
				</div>
				<div class="item">
					<textarea  api-param-name="description" maxlength="500" min="1" placeholder="请输入文章的描述"><?=$description?></textarea>
				</div>
				
				<div class="tools">
					<button class="btn blue-o fr" id="js-save"><i class="fa fa-save"></i>编辑文章</button>
					<button class="btn fl" id="js-picker" style="padding:0;"><i class="fa fa-upload"></i>修改封面图片</button>
					<div class="fileQueued" id="fileQueued">
						<img src="https://static.youku.com/user/img/avatar/310/56.jpg" width="30" height="30">
						<span>上传中</span>
					</div>

					<!-- <div id="uploader" class="wu-example">
					<div id="thelist" class="uploader-list"></div>
					<div class="btns">
					<div id="picker">选择文件</div>
					<button id="ctlBtn" class="btn btn-default">开始上传</button>
					</div>
					</div> -->

				</div>
				<div id="Umediter" api-param-name='content' style="width:100%;height:540px;"><?=$content?></div>
			</div>
			<div class="right">
				<h1 style="text-align: left">浏览图片</h1>
				<img src="<?=$image?>" alt="">
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
	
	<!-- load webuploader -->
	<link href="./assets/bin/webuploader/webuploader.css" rel="stylesheet" type="text/css" >
	<script src="./assets/bin/webuploader/webuploader.js"></script>
	<!-- load webuploader -->

	<script type="text/javascript">
		UM.delEditor('Umediter');
 		um = UM.getEditor('Umediter');



 		var BASE_URL = '';
		var uploader = WebUploader.create({

		    // swf文件路径
		    swf: BASE_URL + '/js/Uploader.swf',

		    // 文件接收服务端。
		    server: './api/admin/article/upload',

		    // 选择文件的按钮。可选。
		    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
		    pick: '#js-picker',

		    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		    resize: true,

		    // 只允许选择图片文件。
		    accept: {
		        extensions: 'gif,jpg,jpeg,bmp,png',
		    }
		});



		// 当有文件被添加进队列的时候
		uploader.on( 'fileQueued', function( file ) {
			// 如果为非图片文件，可以不用调用此方法。
			// thumbnailWidth x thumbnailHeight 为 100 x 100
			uploader.makeThumb( file, function( error, src ) {
				if (error) {
					$img.replaceWith('<span>不能预览</span>');
					return;
				}
				console.log(src)
				$("#fileQueued").show().find('img').attr('src' , src);
			}, 300, 300 );
			uploader.upload();
		});


		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
		    $("#fileQueued span").text(percentage * 100 + '%').css({'color' : 'blue'})
		});



		// 文件上传成功，给item添加成功class, 用样式标记上传成功。
		uploader.on( 'uploadSuccess', function( file , data) {
			try{ 
				var data = $.parseJSON(data._raw);
				if(data.state){
			    	$("#fileQueued span").text('上传成功').css({'color' : 'green'})
				}else{
					popup.toast(data.message.error)
			    	$("#fileQueued span").text('上传失败').css({'color' : 'red'})
				}
			}catch (e){
				popup.toast('上传失败')
		    	$("#fileQueued span").text('上传失败').css({'color' : 'red'})
			} 
			uploader.reset()
		});

		// 文件上传失败，显示上传出错。
		uploader.on( 'uploadError', function( file ) {
		    $("#fileQueued span").text('上传失败').css({'color' : 'red'})
		});

		// 完成上传完了，成功或者失败，先删除进度条。
		uploader.on( 'uploadComplete', function( file ) {
		    $( '#'+file.id ).find('.progress').remove();
		});


 		$("#js-save").click(function(){
 			ApiRequest.push('Article/Edit' , {params : {
 				content : um.getContent(),
 				id : <?=$this->input->get('id' , true)?>
 			}})
 		});
	</script>

</body>
</html>