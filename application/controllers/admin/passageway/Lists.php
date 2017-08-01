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
		$this->load->model('Passageway_model');
		$this->Passageway_model->group_by('paytype');
		$Paytype_list = $this->Passageway_model->get_list(array() , 1 , 1 , array() , 'all');



		if(@$_GET['paytype'] != -1){
			$paytype = isset($_GET['paytype']) ? array('paytype' => $this->input->get('paytype' , true)) : array();
		}else{
			$paytype = array();
		}


		$Passageway_list = $this->Passageway_model->get_list($paytype , 1 , 1 , array() , 'all');
		



		foreach ($Passageway_list as &$value) {
			$value['data'] = json_encode($value);

			$params = json_decode($value['value'] , true);
			$value['html0'] = @"<input type='text' data-param value='{$params[0]}' placeholder='请在此输入{$params[0]}的值'>";
			$value['html1'] = @"<input type='text' data-param value='{$params[1]}' placeholder='请在此输入{$params[1]}的值'>";
			$value['html2'] = @"<input type='text' data-param value='{$params[2]}' placeholder='请在此输入{$params[2]}的值'>";
			$value['html3'] = @"<input type='text' data-param value='{$params[3]}' placeholder='请在此输入{$params[3]}的值'>";
			$value['html4'] = @"<input type='text' data-param value='{$params[4]}' placeholder='请在此输入{$params[4]}的值'>";
			$value['html5'] = @"<input type='text' data-param value='{$params[5]}' placeholder='请在此输入{$params[5]}的值'>";
			$value['html6'] = @"<input type='text' data-param value='{$params[6]}' placeholder='请在此输入{$params[5]}的值'>";
		
			$value['active'] = $value['open'] == 0 ? 'active' : '';
		}

		Loader::view(array('passageway/lists') , array(
			'Passageway_list' => $Passageway_list,
			'Paytype_list' => $Paytype_list
		) , ADMIN_TEMPLATE);
	}
}

