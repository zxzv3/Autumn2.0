<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Live extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');
		$this->load->model('live/Live_model' , 'Live_model');
	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$method = strtolower($method);
		$this->params = Autumn::params("{$this->name}/{$method}" , 'Api/Admin');
		if( ! in_array($method , get_class_methods($this))) show_404();
		$this->$method();
	}



	public function create(){
		$this->params->record_start = strtotime($this->params->record_start) - strtotime(date('Y-m-d'));
		$this->params->record_end = strtotime($this->params->record_end) - strtotime(date('Y-m-d'));
		$this->params->id = md5(date('YmdHis') . rand(10000000 , 99999999));

		if($this->params->record_start >= $this->params->record_end){
			Autumn::end(false , '开始录像时间不能大于结束录像时间');
		}
		$this->Live_model->create($this->params);
		Autumn::end(true);
	}




	public function remove(){
		$Live_data = $this->Live_model->get(array('id' => $this->params->id));
		if( ! isset($Live_data)) Autumn::end(false , '您要修改的直播数据不存在');
		
		$this->Live_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}


	public function edit(){
		$Live_data = $this->Live_model->get(array('id' => $this->params->id));
		if( ! isset($Live_data)) Autumn::end(false , '您要修改的直播数据不存在');
		
		$this->params->record_start = strtotime($this->params->record_start) - strtotime(date('Y-m-d'));
		$this->params->record_end = strtotime($this->params->record_end) - strtotime(date('Y-m-d'));

		if($this->params->record_start >= $this->params->record_end){
			Autumn::end(false , '开始录像时间不能大于结束录像时间');
		}

		$this->Live_model->edit(array('id' => $this->params->id) , $this->params);
		Autumn::end(true);
	}
}