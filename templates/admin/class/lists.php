</head>
<body>

	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools" style="height: 31px;">
			<button class="btn fezocms" id="js-create" style="display: none"><i class="fa fa-plus"></i>创建顶级栏目</button>
			<button class="btn fezocms" id="js-create_song" style="display: none"><i class="fa fa-plus"></i>创建子级栏目</button>
		</div>
		<div class="tools">
			<button class="btn" onclick="window.location.href = './<?=ADMINDIR?>/class/lists' "><i class="fa fa-home"></i>栏目分类</button>
			{Path_list}
			<button class="btn" onclick="window.location.href = './<?=ADMINDIR?>/class/lists?topid={id}' "><i class="fa fa-list"></i>{name}</button>
			{/Path_list}
		</div>
			<table class="table-list" align="center" valign="center">
				<tr>
					<th width="500">栏目名称</th>
					<th width=''>栏目描述</th>
					<th width='190'>拥有分类</th>
					<th width='190'>拥有视频</th>
					<th width='110'>操作</th>
				</tr>

				{Class_list}
				<tr data-data='{data}'>
					<td><button class='btn' style='padding:0 4px;'><span>+</span></button> <a href='./<?=ADMINDIR?>/class/lists?topid={id}' class='btns'>{name}</a></td>
					<td>{description}</td>
					<td><i style='margin-top:2px;color:#aaa;' class='fa fa-list'></i>{count} 个分类</td>
					<td><i style='margin-top:2px;color:#aaa;' class='fa fa-list'></i>{article_count} 个文章</td>
					
					<td>
						<i class='fa fa-edit'></i>
						<i class='fa fa-trash-o'></i>
					</td>
				</tr>
				{/Class_list}


			</table>
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
			<style type="text/css">
				.position{float: left;padding:5px;background-color: #fff;margin-top:10px;}
				.position a{text-decoration: none;border-right: 1px solid #eee;color:#aaa;}
				.position span{color:#ddd;}
				.position a:after{content : " -> ";}
				table a{margin-top:3px;text-decoration: none;color:#555;float: left;}
				table .btn{float:left;margin-right:20px;height: 20px;border:1px solid #e0e0e0;position: relative;top:1px;}
				table .btn span{position: relative;top:-2px;}
				.song td{background-color: #f5f5f5;padding:9px 20px;padding-left:50px;}
			</style>
		
		
	</div>

	
	<script type="text/dom">
		var createClass = <div class="createClass" api-name='Classe/Create'>
			<input api-param-name="name" type="text" placeholder="栏目名称" name="栏目名称" max="16" min="2">
			<textarea api-param-name="description" placeholder="栏目描述" name="栏目描述" max="500" min="0"></textarea>
			<input type="text" api-param-name="view" placeholder="栏目模板" name="栏目模板" max="100" min="0" value="class/view">
		</div>
		var createSongClass = <div class="createClass" api-name='Classe/Create'>
			<input api-param-name="name" type="text" placeholder="栏目名称" name="栏目名称" max="16" min="2">
			<textarea api-param-name="description" placeholder="栏目描述" name="栏目描述" max="500" min="0"></textarea>
			<input type="text" api-param-name="view" placeholder="栏目模板" name="栏目模板" max="100" min="0" value="class/view">
		</div>

		var editClass = <div class="createClass" api-name='Classe/Edit'>
			<input api-param-name="name" type="text" placeholder="栏目名称" name="栏目名称" max="16" min="2" value="{%name%}">
			<textarea api-param-name="description" placeholder="栏目描述" name="栏目描述" max="500" min="0">{%description%}</textarea>
			<input type="text" api-param-name="view" placeholder="栏目模板" name="栏目模板" max="100" min="0" value="{%view%}">
		</div>
		
	</script>
	<?php $this->load->view(ADMINDIR . '/template/footer.php')?>

	<script type="text/javascript">

		$("#js-create").click(function(){
			popup.sure({
				title : '创建顶级栏目' , 
				content : dom.get('createClass') ,
			}).then(function(target){
				ApiRequest.push('Classe/Create' , {params : {type : 'topid'}})
			})
		});


		$("#js-create_song").click(function(){
			popup.sure({
				title : '创建子级栏目' , 
				content : dom.get('createSongClass') ,
			}).then(function(target){
				ApiRequest.push('Classe/Create' , {params : {type : 'songid' , topid : '<?=$this->input->get('topid' , true)?>'}})
			})
		});


		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '编辑栏目',
				content : dom.get('editClass' , data)
			}).then(function(){
				ApiRequest.push('Classe/Edit' , {params : {id : data.id}})
			})
		})




		if(<?=isset($_GET['topid']) ? 'true' : 'false'?>){
			$("#js-create").hide();
			$("#js-create_song").show();
		}else{
			$("#js-create").show();
			$("#js-create_song").hide();
		}



		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除栏目',
				content : '您确定要删除该栏目吗？删除后该栏目将无法恢复，同时该栏目的所有添加的文章将会被移动到未分配组，而该栏目所属的子栏目将全部被删除',
			}).then(function(){
				ApiRequest.push('Classe/Remove' , {params : {id : data.id}})
			})
		})





	</script>
</body>
</html>