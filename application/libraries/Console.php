<?php
class Console{
	static public $CI;
	public function __construct(){
		self::$CI = & get_instance();
	}

	static public function log(){
		
	}
}