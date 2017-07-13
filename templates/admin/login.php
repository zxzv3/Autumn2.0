	<link rel="stylesheet" href="./assets/css/admin/page/login.css">
</head>
<body>
	
	<img src="./assets/images/500460213.jpg" height="100%">
	<div class="login">
		<div class="left">
			<h1>autumn</h1>
			<span>Autumn to the flowers laugh birds</span>
		</div>


		<div class="form" api-name='Admin_user/Login'>
			<h1>登录管理后台</h1>
			<div class="input">
				<span><i class="fa fa-user"></i></span>
				<input type="text" api-param-name="username" maxlength="16" placeholder="请输入登录用户名">
			</div>
			<div class="input">
				<span><i class="fa fa-lock"></i></span>
				<input type="password" api-param-name="password" maxlength="16" placeholder="请输入登录密码">
			</div>
			<button class="btn fezocms" api-event="clickSubmit" api-event-name='Admin_user/Login'>点击登录</button>
		</div>
	</div>



	<?php $this->load->view($template['admin_template'] . '\template\footer')?>
</body>
</html>