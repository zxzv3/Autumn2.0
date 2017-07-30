<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Create extends CI_Controller {

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
		$this->load->model('Class_model');
		$Class_list = Category::unlimitedForLevel($this->Class_model->get_list(array() , 1 , 1 , array('id' , 'name' , 'topid') , 'all'));
		

		Loader::view(array('article/create') , array(
			'Class_list' => $Class_list
		) , ADMIN_TEMPLATE);
	}
}

