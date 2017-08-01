<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Withdrawals extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	public function _remap($method){
		if( ! Autumn::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function lists(){
		$this->load->model('Withdrawals_model');
		$this->load->model('Passageway_model');

		$Withdrawals_list = $this->Withdrawals_model->get_list(array('from_user' => $_SESSION['user']['id']));
		foreach ($Withdrawals_list as &$value) {
			$value['paytype'] = $this->Passageway_model->get(array('id' => $value['paytype']))['name'];
			
			$value['recorded'] = $value['type'] == 1 ? round($value['money'] - (($value['money'] / 100) * $value['rate']) , 2) : 0;
			$value['recorded_label'] = $value['type'] == 1 ? 'success' : '';



			$value['type'] = array(
				'<span class="label">等待支付</span>',
				'<span class="label success">支付成功</span>',
				'<span class="label danger">支付超时</span>',
			)[$value['type']];
			$value['notice'] = array(
				'<span class="label">未通知</span>',
				'<span class="label success">已通知</span>',
			)[$value['notice']];
		}

		Loader::view(array('withdrawals/lists') , array(
			'Withdrawals_list' => $Withdrawals_list
		) , HOME_TEMPLATE);
	}

	
}

