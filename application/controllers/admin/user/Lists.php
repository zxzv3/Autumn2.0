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
		$this->load->model('User_group_model');
		$Group_list = $this->User_group_model->get_list(array());

		$this->load->model('User_model');
		$User_list = $this->User_model->get_list(array());

		foreach ($User_list as &$value) {
			$value['data'] = json_encode($value);
			$group = $this->User_group_model->get(array('id' => $value['from_group']));
			$value['state'] = array(
				'<span class="label success">正常</span>',
				'<span class="label danger">封禁</span>'
			)[$value['state']];
			$value['lost_ip'] = $value['lost_ip'] == '' ? '从未登录' : $value['lost_ip'];
			$value['lost_time'] = $value['lost_time'] == '0000-00-00 00:00:00' ? '从未登录' : $value['lost_time'];
			$value['from_group'] = '<span class="label">' . $group['name'] . '</span>';
		}

		Loader::view(array('user/lists') , array(
			'User_list' => $User_list,
			'Group_list' => $Group_list
		) , ADMIN_TEMPLATE);
	}
}

