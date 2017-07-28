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

		$this->load->model("Class_model");
		$this->load->model("Article_model");
		$topid = $this->input->get('topid' , true);

		if( ! isset($_GET['topid'])){
			$Class_list = $this->Class_model->get_list(array('level' => 0) );
			$Path_list = array();
			$list_count = $this->Class_model->get_count(array('level' => 0));
		}else{
			if( ! $this->Class_model->is_exist(array('id' => $topid))) show_404();

			$list_count = $this->Class_model->get_count(array('topid' => $topid));
			$Class_list = $this->Class_model->get_list(array('topid' => $topid) );

			$Class_data = $this->Class_model->get(array('id' => $topid));
			$Path_list = $this->Class_model->get_list_by('`id` in (' . $Class_data['path'] . ')' , 1 , 1 , array() , 'all' , array('id' => 'asc'));
		}

		foreach ($Class_list as &$value) {
			$value['data'] = json_encode($value);
			$value['description'] = mb_substr($value['description'] , 0 , 30);

			$Song_class = $this->Class_model->get_list("`path` like '%{$value['id']}%' and `id` != '{$value['id']}'" , 1 , 1 , array() , 'all');
			$value['count'] = count($Song_class);


			$value['article_count'] = $this->Article_model->get_count(array('from_class' => $value['id']));
		}
		Loader::view(array('class/lists') , array(
			'list_count' => $list_count,
			'Class_list' => $Class_list , 
			'Path_list' => $Path_list ,
			'Class_data' => @$Class_data
		) , ADMIN_TEMPLATE);
	}
}

