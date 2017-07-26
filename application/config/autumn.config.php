<?php
$config['autumn'] = array(
	'static_url' => true,
	'base_url' => 'http://' . @$_SERVER['HTTP_HOST'] . $_SERVER["SCRIPT_NAME"]
);


$config['home_jurisdiction'] = array(
	'发布时间' => array(
		'30天' => 'ds'
	)
);


$config['admin_jurisdiction'] = array(
	'管理员管理' => array(
		'添加' => 'admin_user_create' ,
		'编辑' => 'admin_user_edit' ,
		'删除' => 'admin_user_remove' ,
		'查看用户' => 'admin_user_view' ,
		'编辑自己' => 'admin_user_edit_myslef' ,
	) ,
	'权限组' => array(
		'添加' => 'group_create' ,
		'编辑' => 'group_edit' ,
		'删除' => 'group_remove' ,
		'查看' => 'group_view' ,
	) ,
	'用户管理' => array(
		'编辑用户' => 'user_edit' ,
		'封清操作' => 'user_danger' ,
		'修改收款信息' => 'user_qrcode' ,
		'查看用户列表' => 'user_view' ,
	) ,
	'充值管理' => array(
		'单个删除' => 'order_delete' ,
		'批量删除' => 'order_delete_all' ,
		'到账处理' => 'order_success' ,
		'查看充值' => 'order_view' ,
	) ,
	'提现管理' => array(
		'单个删除' => 'atm_delete' ,
		'批量删除' => 'atm_delete_all' ,
		'拒绝或允许操作' => 'atm_check' ,
		'查看提现' => 'atm_view' ,
	) ,
	
	'其他设置' => array(
		'查看设置' => 'config_view' ,
		'修改设置' => 'config_edit' ,
		'调整金币比利' => 'config_money' ,
	) ,
	
	'收款设置' => array(
		'批量删除' => 'qrcode_delete_all' ,
		'创建二维码' => 'qrcode_create' ,
		'单个删除' => 'qrcode_delete' ,
		'查看收款' => 'qrcode_view' ,
	) ,	
);