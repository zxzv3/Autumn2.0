	<link rel="stylesheet" href="./assets/css/home/page/home.css?<?=time()?>">
	<link rel="stylesheet" href="./assets/bin/layui/css/layui.css">
</head>
<body ondragstart="return false;">
	<div class="tools" id="js-tools">
		<div class="item gloss">
			<img src="./assets/images/folder_win10.png" >
		</div>
		<div class="item gloss">
			<img src="./assets/images/folder_win10.png" >
		</div>
		<div class="item gloss">
			<img src="./assets/images/folder_win10.png" >
		</div>

	</div>
	
	<div class="warpper">
		<div class="icon" id="js-menu">
			<div class="item gloss" data-name="center">
				<img src="./assets/images/server.png">
				<span>发布中心</span>
			</div>
			<div class="item gloss" data-name="image">
				<img src="./assets/images/folder_win10.png">
				<span>产品图片</span>
			</div>
			<div class="item gloss" data-name="article">
				<img src="./assets/images/folder_win10.png">
				<span>文章模板</span>
			</div>
			<div class="item gloss" data-name="">
				<img src="./assets/images/folder_win10.png">
				<span>过期帐号</span>
			</div>
		</div>
	</div>

	<script type="text/dom">
		var center = <div class="center">
			<div class="top-header">
				<div class="l">
					<img src="./assets/images/server.png"/>
				</div>
				<div class="r">
					<span>发布端服务已经准备就绪</span>
					<button class="btn blue-o fr"><i class="fa fa-list"></i>开始发布</button>
					<div class="layui-progress layui-progress-big fl" lay-showPercent="true">
						<div class="layui-progress-bar layui-bg-blue" lay-percent="80%" style="width: 10%"></div>
					</div>
				</div>
			</div>
			

			<div class="function">
				<button class="btn" title="创建信息标题"><i class="fa fa-plus"></i>创建标题</button>
				<button class="btn" title="标题创建历史记录"><i class="fa fa-history"></i>创建历史</button>
				<button class="btn" title="清理已发布成功的标题"><i class="fa fa-eraser"></i>清理成功</button>
				<button class="btn" title="重置发布失败的标题"><i class="fa fa-undo"></i>失败重发</button>
				<button class="btn" title="清空全部标题"><i class="fa fa-times"></i>清空标题</button>
				<button class="btn" title="设置信息发布时间"><i class="fa fa-clock-o"></i>计划任务</button>
				<button class="btn" title="账号资料修改"><i class="fa fa-cog"></i>账号设置</button>
				<button class="btn" title="今日发布详情"><i class="fa fa-cloud-upload"></i>发布日志</button>
			</div>

			<table class="table-list">
				<tr>
					<th>编号</th>
					<th>信息标题</th>
					<th>发布时间</th>
					<th>发布状态</th>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>
				<tr>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
					<td>dsa</td>
				</tr>



			</table>



		</div>
		
		

		var tools-item = <div class="item gloss" data-name="{%name%}" data-from-layer="{%from_layer%}">
			<img src="{%url%}">
		</div>
	</script>


	<?php $this->load->view(HOME_TEMPLATE . '/template/footer');?>
	<script src="./assets/bin/layui/layui.js"></script>
	<script type="text/javascript">
		var layer;
		var element
		layui.use('layer', function(){
			layer = layui.layer;
		});
		layui.use('element', function(){
			element = layui.element();
		});

		setTimeout(function(){
			$("#js-menu .item:eq(0)").click()
		} , 300)


		var openWindowList = [];
		$("#js-menu .item").click(function(){
			var name = $(this).data('name');
			if($.inArray(name, openWindowList) != -1) return false;

			switch(name){
				case 'center' : 
					style = {
						name : 'center',
						image : "./assets/images/server.png",
						title : '<img src="./assets/images/server.png" class="center-icon" />发布中心' , 
						content : dom.get('center') , 
						icon : 5, 
						area : ['962px' , '650px']
					};
				break;
			}

			
			var data = layer.open({
				title : style.title,
				type: 1,
				icon : style.icon,
				area: style.area,
				shade : 0,
				fixed : false ,
				shadeClose:false,
				maxmin:true,
				content: style.content,
				cancel : function(){
					$("#js-tools [data-name='" + style.name + "']").remove().empty();
					openWindowList = $.grep(openWindowList, function(value) {
						return value != style.name;
					});
				},
				success: function(layero, index){
					$("#js-tools").append(dom.get('tools-item' , {
						name : style.name,
						url : style.image,
						from_layer : layero.selector
					}))
					openWindowList.push(style.name)
				}
			});

			// 将打开的窗口的图标加到工具栏中
		})
		
	</script>
</body>
</html>