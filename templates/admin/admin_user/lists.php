	<style>
		body{min-width: 1400px;}
		.top li{
			margin-bottom: 15px;
			margin-right: 4px;sddss
			float: left;
		}
	</style>
</head>
<body>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/menu.php')?>
	<?php $this->load->view(ADMIN_TEMPLATE . '/template/top-header.php')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn active" id="js-create-admin-user"><i class="fa fa-user-plus"></i>添加管理员</button>
			<!-- <button class="btn" id="js-search"><i class="fa fa-search"></i>搜索筛选</button> -->
			<select id="js-switch" name='group'>
				{Group_list}
				<option value="{name}">{name}</option>
				{/Group_list}
			</select>
		</div>
		<table class="table-list">
			<tr>
				<th width="50"><div class="widget-checkbox"></div></th>
				<th>管理员权限组</th>
				<th>管理员账户</th>
				<th>最后登录时间</th>
				<th>最后登录IP</th>
				<th>登录平台次数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			{Admin_user_list}
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
			{/Admin_user_list}
		</table>		
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
		
	</div>
	

	<script type="text/dom">
		var create-admin-user = <div class="create-admin-user" api-name="Admin_user/Create">
			<input type="text" placeholder="管理员帐号" name="管理员帐号" api-param-name="username" max="16" min="6">
			<input type="text" placeholder="管理员密码" name="管理员密码" api-param-name="password" max="16" min="6">
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
		var edit-admin-user = <div class="edit-admin-user" api-name="Admin_user/Edit">
			<input type="text" placeholder="管理员帐号" name="管理员帐号" api-param-name="username" value="{%username%}" max="16" min="6">
			<input type="text" placeholder="管理员密码(为空则不修改)" name="管理员密码" api-param-name="password" max="16" min="0">
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
				title : '添加管理员',
				content : dom.get('create-admin-user')
			}).then(function(){
				ApiRequest.push('Admin_user/Create')
			})
		});
		
		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			if(data.from_group == 1){
				popup.toast('您无权编辑超级管理员账户')
				return false;
			}
			popup.sure({
				title : '删除管理员',
				content : dom.get('edit-admin-user' , data)
			}).then(function(){
				ApiRequest.push('Admin_user/Edit' , {params : {id : data.id}})
			})
		})

		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			if(data.from_group == 1){
				popup.toast('您无权删除超级管理员账户')
				return false;
			}
			popup.sure({
				title : '删除管理员',
				content : '您确定要删除这个管理员吗，删除后将无法找回该管理员'
			}).then(function(){
				ApiRequest.push('Admin_user/Remove' , {params : {id : data.id}})
			})
		})
	</script>
</body>
</html>