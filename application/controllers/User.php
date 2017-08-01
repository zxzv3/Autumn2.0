<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	public function _remap($method){
		if( ! Autumn::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function base(){
		
		Loader::view(array('user/base') , array(
		) , HOME_TEMPLATE);
	}

	public function card(){
		
		Loader::view(array('user/card') , array(
		) , HOME_TEMPLATE);
	}
}

