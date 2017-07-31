		<style>
		.create-admin-user .checkbox span{position: relative;top:3px;}
		.create-admin-user .limit{border-radius:5px;margin-top:10px;float:left;width:100%;padding:8px 14px;background-color:#f3f3f3;max-height:400px;overflow:hidden;overflow-y:scroll}
		.create-admin-user .limit h2{float:left;width:100%;color:#aaa;font-weight:400;font-size:12px;margin-bottom:14px;margin-top:14px}
		.create-admin-user .limit .widget-checkbox{margin-top:3px;margin-right:5px}
		.create-admin-user .limit label{margin-left:10px;margin-right:15px;margin-bottom:11px;float:left}
	</style>
</head>
<body>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/menu.php')?>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn active" id="js-create-admin-user"><i class="fa fa-user-plus"></i>添加商户</button>
			<select id="">
				{Group_list}
				<option value="{name}">{name}</option>
				{/Group_list}
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th width="50"><div class="widget-checkbox"></div></th>
				<th>商户ID</th>
				<th>未提余额</th>
				<th>商户权组</th>
				<th>商户帐号</th>
				<th>商户密钥</th>
				<th>最后登录时间</th>
				<th>最后登录IP</th>
				<th>登录次数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			{User_list}
			<tr data-data='{data}'>
				<td width="50"><div class="widget-checkbox"></div></td>
				<td>{id}</td>
				<td>￥{money}</td>
				<td>{from_group}</td>
				<td>{username}</td>
				<td>{merchant_key}</td>
				<td>{lost_time}</td>
				<td>{lost_ip}</td>
				<td>{count}次</td>
				<td>{state}</td>
				<td>
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				</td>
			</tr>
			{/User_list}
		</table>		
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
		
	</div>
	

	<script type="text/dom">
		var create-admin-user = <div class="create-admin-user" api-name="User/Create">
			<div class="left">
				<input type="text" placeholder="商户帐号" name="商户帐号" api-param-name="username" max="16" min="6">
				<input type="text" placeholder="商户密码" name="商户密码" api-param-name="password" max="16" min="6">
				<select api-param-name="group">
					{Group_list}
					<option value="{id}">{name}</option>
					{/Group_list}
				</select>
				<select  api-param-name="state">
					<option value="0">正常</option>
					<option value="1">封禁</option>
				</select>
				<div class="limit">
					<h2>开放支付权限</h2>
					<?php
						foreach ($Paytype_list as $key => $value) {
							echo '<label class="checkbox" for="js-' . $value['id'] . '"><div class="widget-checkbox two2" data-paytype="' . $value['paytype'] . '" name="js-' . $value['id'] . '" id="js-' . $value['id'] . '"></div><span>' . $value['paytype'] . '</span></label>';
						}
					?>
				</div>
			</div>
			<div class="right" id="js-right">
				<input type="text" placeholder="请输入的费率">
				<input type="text" placeholder="请输入的费率">
				<input type="text" placeholder="请输入的费率">
				<input type="text" placeholder="请输入的费率">
				<input type="text" placeholder="请输入的费率">
			</div>

			<style>
				.left{float: left;width: 400;}
				.right{float: left;width: 180px;margin-left: 35px;display: none}
			</style>
		</div>




		var edit-admin-user = <div class="create-admin-user" api-name="User/Edit">
			<input type="text" placeholder="商户帐号" name="商户帐号" api-param-name="username" value="{%username%}" max="16" min="6">
			<input type="text" placeholder="商户密码(为空则不修改)" name="商户密码" api-param-name="password" max="16" min="0">
			<select api-param-name="group" value="{%from_group%}">
				{Group_list}
				<option value="{id}">{name}</option>
				{/Group_list}
			</select>
			<select  api-param-name="state" value="{%state%}">
				<option value="0">正常</option>
				<option value="1">封禁</option>
			</select>
			<div class="limit">
				<h2>开放支付权限</h2>
				<?php
					foreach ($Paytype_list as $key => $value) {
						echo '<label class="checkbox" for="' . $value['paytype'] . '"><div class="widget-checkbox two2" data-paytype="' . $value['paytype'] . '" name="' . $value['paytype'] . '" id="' . $value['paytype'] . '"></div><span>' . $value['paytype'] . '</span></label>';
					}
				?>
			</div>
		</div>

	</script>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/footer.php')?>
	<script type="text/javascript">
		// $('body').on('click' , '.limit .widget-checkbox' , function(){
		// 	$(".popup .popup-sure").animate({width : 700} , function(){
		// 		$("#js-right").show()
		// 	})
		// });





		$("#js-create-admin-user").click(function(){
			popup.sure({
				title : '添加商户',
				content : dom.get('create-admin-user')
			}).then(function(target){
				var limit = [];
				target.popup.find(".limit .widget-checkbox").each(function(index, el) {
					if($(el).is('.active')){
						limit.push($(el).attr('data-paytype'))
					}
				});
				ApiRequest.push('User/Create' , {params : {
					paytype : limit
				}})
			})
		});


		
		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '编辑商户',
				content : dom.get('edit-admin-user' , data)
			}).then(function(target){
				var limit = [];
				target.popup.find(".limit .widget-checkbox").each(function(index, el) {
					if($(el).is('.active')){
						limit.push($(el).attr('data-paytype'))
					}
				});
				ApiRequest.push('User/Edit' , {params : {
					id : data.id,
					paytype : limit
				}})
			})
			$.each($.parseJSON(data.paytype) , function(key , value){
				$("#" + value).addClass('active');
			})
		})



		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除商户',
				content : '您确定要删除这个商户吗，删除后将无法找回该商户'
			}).then(function(){
				ApiRequest.push('User/Remove' , {params : {id : data.id}})
			})
		})
	</script>
</body>
</html>