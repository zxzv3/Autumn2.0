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
		$this->load->model('Order_model');
		$this->load->model('Passageway_model');
		$Order_list = $this->Order_model->get_list(array());
		foreach ($Order_list as &$value) {
			$value['paytype'] = $this->Passageway_model->get(array('id' => $value['paytype']))['name'];
			$value['type'] = array(
				'<span class="label">等待支付</span>',
				'<span class="label success">支付成功</span>',
				'<span class="label danger">支付超时</span>',
			)[$value['type']];
		}


		Loader::view(array('order/lists') , array(
			'Order_list' => $Order_list
		) , ADMIN_TEMPLATE);
	}
}

