<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit extends CI_Controller {

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
		$this->load->model('Article_model');
		$Article_data = $this->Article_model->get(array('id' => $this->input->get('id' , true)));
		$Class_list = Category::unlimitedForLevel($this->Class_model->get_list(array() , 1 , 1 , array('id' , 'name' , 'topid') , 'all'));
		

		Loader::view(array('article/edit') , array(
			'Class_list' => $Class_list,
			'image' => $Article_data['image'],
			'from_class' => $Article_data['from_class'],
			'title' => $Article_data['title'],
			'description' => $Article_data['description'],
			'content' => html_entity_decode($Article_data['content']),
			'keywords' => $Article_data['keywords'],
		) , ADMIN_TEMPLATE);
	}
}

