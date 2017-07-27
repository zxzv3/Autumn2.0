<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {

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
		$this->load->model('User_setting_model');
		$this->load->model('User_group_model');
		$User_setting_list = $this->User_setting_model->get_list(array() , 1 , 1 , array() , 'all');
		
		foreach ($User_setting_list as &$value) {
			$value['data'] = json_encode($value);
			if($value['from_group'] == '-1'){
				$value['from_group'] = '<span class="label">不关联</span>';
			}else{
				$Group_data = $this->User_group_model->get(array('id' => $value['from_group']));
				$value['from_group'] = '<span class="label blue">' . $Group_data['name'] . '</span>';
			}

			switch ($value['type']) {
				case 'input' : $value['html'] = "<input type='text' value='{$value['value']}' placeholder='请在此输入{$value['name']}的值'>";break;
				default:
					$value['html'] = "<input type='text' value='{$value['value']}' placeholder='请在此输入{$value['name']}的值'>";
				break;
			}
		}

		$Group_list = $this->User_group_model->get_list(array() , 1 , 1 , array() , 'all');
		Loader::view(array('user/setting') , array(
			'User_setting_list' => $User_setting_list,
			'Group_list' => $Group_list,
		) , ADMIN_TEMPLATE);
	}
}

