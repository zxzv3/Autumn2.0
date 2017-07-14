<?php
$config['autumn'] = array(

	'controller' => array(
		'admin_dir' => 'admin' ,
		'home_dir' => 'home' ,
	),


	// 模板文件路径
	'template' => array(
		'admin_template' => 'admin' ,
		'home_template' => 'home' ,
	),

	'base_url' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["SCRIPT_NAME"]
);


