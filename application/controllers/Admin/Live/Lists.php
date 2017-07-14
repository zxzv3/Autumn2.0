<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lists extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');
		$this->load->model('live/Live_model' , 'Live_model');

	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$method = strtolower($method);
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		if( ! in_array($method , get_class_methods($this))) show_404();
		$this->$method();
	}



	public function index(){
		$Live_list = $this->Live_model->get_list(array());
		foreach ($Live_list as &$value) {
			$value['record_start'] = date('H:i:s' , strtotime(date('Y-m-d')) + $value['record_start']);
			$value['record_end'] = date('H:i:s' , strtotime(date('Y-m-d')) + $value['record_end'] - 1);
			$value['data'] = json_encode($value);





			$value['date'] = $value['record_start'] . " - " . $value['record_end'];
			$value['record_type'] = array(
				'<span class="label danger">不录像</span>',
				'<span class="label success">定时录像</span>',
			)[$value['record_type']];
		}

		Loader::view(array('live/lists') , array(
			'Live_list' => $Live_list,
		) , ADMINDIR);
	}
}