<div class="left-menu">
 	<!-- <div class="header-image"> -->
		<!-- <img src="http://qlogo4.store.qq.com/qzone/123456/123456/50?1458033117"> -->
 	<!-- </div> -->
	<div class="item">
		<div class="title">
			<i class="fa left fa-home"></i>
			<h2>首页管理</h2>
			<i class="fa fa-angle-down"></i>
		</div>

		<div class="song">
			<ul>
				<li><a href="./admin"><i class="fa fa-home"></i>后台首页</a></li>
			</ul>
		</div>
	</div>

	<div class="item">
		<div class="title">
			<i class="fa left fa-file-video-o"></i>
			<h2>直播管理</h2>
			<i class="fa fa-angle-down"></i>
		</div>

		<div class="song">
			<ul>
				<li><a href="./<?=$controller['admin_dir']?>/live/lists"><i class="fa fa-calculator"></i> 直播列表</a></li>
				<!-- <li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> 直播设置</a></li> -->
				<li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> 录像回放</a></li>
			</ul>
		</div>
	</div>



	<div class="item">
		<div class="title">
			<i class="fa left fa-database"></i>
			<h2>转码管理</h2>
			<i class="fa fa-angle-down"></i>
		</div>

		<div class="song">
			<ul>
				<li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> 转码队列</a></li>
				<li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> API 设置</a></li>
			</ul>
		</div>
	</div>
	

	<div class="item">
		<div class="title">
			<i class="fa left fa-cogs"></i>
			<h2>系统设置</h2>
			<i class="fa fa-angle-down"></i>
		</div>

		<div class="song">
			<ul>
				<li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> 系统设置</a></li>
				<li><a href="./{admin_view}/logs"><i class="fa fa-calculator"></i> 系统升级</a></li>
			</ul>
		</div>
	</div>
</div>