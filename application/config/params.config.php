<?php

$config['params'] = array(

	"api/admin" => array(
		"Admin_user/login:POST" => array(
			'username' => array('min' => 6 , 'max' => 16 , 'name' => '用户名'),
			'password' => array('min' => 6 , 'max' => 16 , 'name' => '密码'),
		),


		


		"Live/edit:POST" => array(
			'id' => array('min' => 32 , 'max' => 32 , 'name' => 'id'),
			'video_name' => array('min' => 2 , 'max' => 32 , 'name' => '直播标题'),
			'record_start' => array('min' => 8 , 'max' => 8 , 'name' => '录像开始时间'),
			'record_end' => array('min' => 8 , 'max' => 8 , 'name' => '录像结束时间'),
			'store_time' => array('min' => 1 , 'max' => 2 , 'name' => '录像天数'),
			'record_type' => array('min' => 1 , 'max' => 1 , 'name' => '录像类型'),
		) ,


		"Live/remove:POST" => array(
			'id' => array('min' => 32 , 'max' => 32 , 'name' => 'id'),
		) ,


		"Live/create:POST" => array(
			'video_name' => array('min' => 2 , 'max' => 32 , 'name' => '直播标题'),
			'record_start' => array('min' => 8 , 'max' => 8 , 'name' => '录像开始时间'),
			'record_end' => array('min' => 8 , 'max' => 8 , 'name' => '录像结束时间'),
			'store_time' => array('min' => 1 , 'max' => 2 , 'name' => '录像天数'),
			'record_type' => array('min' => 1 , 'max' => 1 , 'name' => '录像类型'),
		) ,

	)



);

