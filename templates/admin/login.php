	<link rel="stylesheet" href="./assets/css/admin/page/login.css">
</head>
<body>
	
	<img src="./assets/images/500460213.jpg" height="100%">
	<div class="login">
		<div class="left" style="padding-top:26px;">
			<!-- <h1>autumn</h1>
			<span>Autumn to the flowers laugh birds</span> -->
			<img src="./assets/images/logo.png" width="80%" alt=""><br>
			<span>视频连接世界</span>
		</div>


		<div class="form" api-name='Admin_user/Login'>
			<h1>登录管理后台</h1>
			<div class="input">
				<span><i class="fa fa-user"></i></span>
				<input type="text" api-param-name="username" max="16" min="6" maxlength="16" name="用户名" placeholder="请输入登录用户名">
			</div>
			<div class="input">
				<span><i class="fa fa-lock"></i></span>
				<input type="password" api-param-name="password" max="16" min="6" maxlength="16" name="密码" placeholder="请输入登录密码">
			</div>
			<button class="btn fezocms" api-event="clickSubmit">点击登录</button>
		</div>
	</div>


	<?php $this->load->view($template['admin_template'] . '\template\footer')?>
	<script type="text/javascript">
		function ApiRequestSuccess(name , data){
			if(name == 'Admin_user/Login'){
				popup.toast('登录成功，正在跳转至后台首页，请稍等');
				ApiRequest.success();
			}
		}
		function ApiRequestError(data , error){
			popup.toast(error.message)
		}


		ApiRequest.set({
			success : ApiRequestSuccess,
			error : ApiRequestError,
		})
	</script>
</body>
</html>