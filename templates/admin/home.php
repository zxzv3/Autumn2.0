	<style>
		body{min-width: 1400px;}
		.top li{
			margin-bottom: 15px;
			margin-right: 4px;
			float: left;
		}
	</style>
</head>
<body>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/menu.php')?>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/top-header.php')?>
	<?php
		$maxDisk = round(disk_total_space(FCPATH) / 1024 / 1024 / 1024 , 0);
		$nowDisk = round(disk_free_space(FCPATH) / 1024 / 1024 / 1024);

	?>
	<div class="warpper">
		
		<div class="box fl">
			<h1>环境状态</h1>
			<div class="left fl">
				<p>版本号：1.0</p>
				<p>PHP版本：<?=PHP_VERSION?></p>
				<p>Mysql版本：<?=$mysql_version?></p>
			</div>
		</div>
		

		<div class="box">
			<h1>详细数据</h1>
			<?php
				include './tz.php';
			?>
		</div>
		
		
	</div>
	
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/footer.php')?>

</body>
</html>