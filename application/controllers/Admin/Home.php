<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');
	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$method = strtolower($method);
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		if( ! in_array($method , get_class_methods($this))) show_404();
		$this->$method();
	}


	public function index(){

		Loader::view(array('home') , array() , ADMINDIR);
	}
}