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
	<div class="warpper">
		<div class="tools">
			<button class="btn active" id="js-create-admin-user"><i class="fa fa-user-plus"></i>添加用户</button>
			<select id="">
				{Group_list}
				<option value="{name}">{name}</option>
				{/Group_list}
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th width="50"><div class="widget-checkbox"></div></th>
				<th>用户权组</th>
				<th>用户帐号</th>
				<th>最后登录时间</th>
				<th>最后登录IP</th>
				<th>登录次数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			{User_list}
			<tr data-data='{data}'>
				<td width="50"><div class="widget-checkbox"></div></td>
				<td>{from_group}</td>
				<td>{username}</td>
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
			<input type="text" placeholder="用户帐号" name="用户帐号" api-param-name="username" max="16" min="6">
			<input type="text" placeholder="用户密码" name="用户密码" api-param-name="password" max="16" min="6">
			<select api-param-name="group">
				{Group_list}
				<option value="{id}">{name}</option>
				{/Group_list}
			</select>
			<select  api-param-name="state">
				<option value="0">正常</option>
				<option value="1">封禁</option>
			</select>
		</div>
		var edit-admin-user = <div class="edit-admin-user" api-name="User/Edit">
			<input type="text" placeholder="用户帐号" name="用户帐号" api-param-name="username" value="{%username%}" max="16" min="6">
			<input type="text" placeholder="用户密码(为空则不修改)" name="用户密码" api-param-name="password" max="16" min="0">
			<select api-param-name="group" value="{%from_group%}">
				{Group_list}
				<option value="{id}">{name}</option>
				{/Group_list}
			</select>
			<select  api-param-name="state" value="{%state%}">
				<option value="0">正常</option>
				<option value="1">封禁</option>
			</select>
		</div>
	</script>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/footer.php')?>
	<script type="text/javascript">
		$("#js-create-admin-user").click(function(){
			popup.sure({
				title : '添加用户',
				content : dom.get('create-admin-user')
			}).then(function(){
				ApiRequest.push('User/Create')
			})
		});
		
		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除用户',
				content : dom.get('edit-admin-user' , data)
			}).then(function(){
				ApiRequest.push('User/Edit' , {params : {id : data.id}})
			})
		})

		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除用户',
				content : '您确定要删除这个用户吗，删除后将无法找回该用户'
			}).then(function(){
				ApiRequest.push('User/Remove' , {params : {id : data.id}})
			})
		})
	</script>
</body>
</html>