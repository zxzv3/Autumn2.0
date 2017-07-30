<?php
class Payment{
	static public $CI;
	public function __construct(){
		self::$CI = & get_instance();
	}

	static public function huaqi($payment){

		return array(
			'state' => true,
		);
	}
}