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
		$this->load->model('Admin_user_model');
		$this->load->model('Admin_group_model');
		$Admin_user_list = $this->Admin_user_model->get_list();
		$Group_list = $this->Admin_group_model->get_list();

		foreach ($Admin_user_list as &$value) {
			$value['data'] = json_encode($value);
			$group = $this->Admin_group_model->get(array('id' => $value['from_group']));
			$value['state'] = array(
				'<span class="label success">正常</span>',
				'<span class="label danger">封禁</span>'
			)[$value['state']];
			$value['from_group'] = $value['from_group'] == '1' ? '<span class="label danger">' . $group['name'] . '</span>' : '<span class="label">' . $group['name'] . '</span>';
		}


		Loader::view(array('admin_user/lists') , array(
			'Admin_user_list' => $Admin_user_list,
			'Group_list' => $Group_list,
			'list_count' => $this->Admin_user_model->get_count()
		) , ADMIN_TEMPLATE);
	}
}

