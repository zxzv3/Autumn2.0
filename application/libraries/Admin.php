<?php
class Admin{
	static public $CI;
	public function __construct(){
		self::$CI = & get_instance();
	}

	static public function is_login(){
		if( ! isset($_SESSION['admin_user'])){
			Loader::view(array(
				'/login'
			) , array() , 'admin');
			return false;
		}
		return true;
	}
}