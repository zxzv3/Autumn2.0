	<link rel="stylesheet" href="./assets/css/home/page/login.css">
</head>
<body>
	<div class="back">
		<img src="./assets/images/500460213.jpg" alt="">
	</div>
	<div class="login">
		<div class="top-header">
			<h1>B2B离线云发布系统</h1>
			<span>B2B offline cloud publishing system</span>
		</div>
		<div class="box" api-name="User/Login">
			<div class="item">
				<span style="margin-left: -1px;"><i class="fa fa-user"></i></span>
				<input type="text" placeholder="请在此输入您的帐号" max="16" min="6" name="帐号" api-param-name="username">
			</div>
			<div class="item">
				<span><i class="fa fa-lock"></i></span>
				<input type="password" placeholder="请在此输入您的密码" max="16" min="6" name="密码" api-param-name="password">
			</div>
			<div class="item">
				<label>
					<div class="widget-checkbox"></div>
					记住密码
				</label>
				<a href="" class="repassword">忘记密码</a>
			</div>
			<button class="btn fezocms" api-event='clickSubmit'><i class="fa fa-user-o"></i>登录到系统</button>
			<button class="btn blue-o">没有帐号？点击注册</button>
		</div>
	</div>
	<?php $this->load->view(HOME_TEMPLATE . '/template/footer');?>
	<script type="text/javascript">
		

	</script>
</body>
</html>