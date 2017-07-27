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


		$this->load->model('Setting_model');
		$Setting_list = $this->Setting_model->get_list(array() , 1 , 1 , array() , 'all');
		

		foreach ($Setting_list as &$value) {
			$value['data'] = json_encode($value);

			switch ($value['type']) {
				case 'input' : $value['html'] = "<input type='text' value='{$value['value']}' placeholder='请在此输入{$value['name']}的值'>";break;
				default:
					$value['html'] = "<input type='text' value='{$value['value']}' placeholder='请在此输入{$value['name']}的值'>";
				break;
			}
		}

		Loader::view(array('setting/base') , array(
			'Setting_list' => $Setting_list,
		) , ADMIN_TEMPLATE);
	}
}

