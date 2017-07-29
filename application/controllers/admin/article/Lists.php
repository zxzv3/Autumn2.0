<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lists extends CI_Controller {

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
		
		$Class_list = Category::unlimitedForLevel($this->Class_model->get_list(array() , 1 , 1 , array('id' , 'name' , 'topid') , 'all'));
		$Article_list = $this->Article_model->get_list(array());
		foreach ($Article_list as &$value) {
			$value['from_class'] = $this->Class_model->get(array('id' => $value['from_class']))['name'];
			$value['content'] = mb_substr(strip_tags(htmlspecialchars_decode($value['content'])), 0 , 30) . '...';
		}


		Loader::view(array('article/lists') , array(
			'Class_list' => $Class_list,
			'Article_list' => $Article_list,
			'list_count' => $this->Article_model->get_count(),
		) , ADMIN_TEMPLATE);
	}
}

