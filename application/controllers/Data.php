<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	public function _remap($method){
		if( ! Autumn::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function index(){
		
		Loader::view(array('data/home') , array(
		) , HOME_TEMPLATE);
	}

	public function api(){
		
		Loader::view(array('data/api') , array(
		) , HOME_TEMPLATE);
	}
}

