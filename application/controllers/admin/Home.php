<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function index(){
		$this->load->model('Admin_user_model');
		$data = $this->Admin_user_model->query('select VERSION();')->result_array();

		Loader::view(array('home') , array(
			'mysql_version' => $data[0]['VERSION()']
		) , ADMIN_TEMPLATE);
	}
}

