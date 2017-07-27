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
	'管理员' => array(
		'添加' => 'api/admin/Admin_user/create' ,
		'编辑' => 'api/admin/Admin_user/edit' ,
		'删除' => 'api/admin/Admin_user/remove',
		'查看' => 'admin_user_view' ,
		'编辑自己' => 'admin_user_edit_myslef' ,
	) ,
	
);