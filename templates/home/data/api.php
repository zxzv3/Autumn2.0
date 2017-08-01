	<link rel="stylesheet" type="text/css" href="./assets/css/home/page/home.css">
</head>
<body>
	<?php $this->load->view(HOME_TEMPLATE . '/template/top-header')?>
	<?php $this->load->view(HOME_TEMPLATE . '/template/menu')?>
	<div class="warpper">
		<div class="box" style="padding:30px;">
			<h1>API 密钥</h1>
			<table class="table-list setting" style="width: 500px;">
				<tr>
					<td>API 网关地址</td>
					<td>http://<?=@$_SERVER['HTTP_HOST']?>/v1</td>
				</tr>
				<tr>
					<td>API 密钥</td>
					<td><?=$_SESSION['user']['merchant_key']?></td>
				</tr>
			</table>
		</div>
	</div>
    <?php $this->load->view(HOME_TEMPLATE . '/template/footer');?>
    <script type="text/javascript" src="./assets/js/home/home.js"></script>
</body>
</html>