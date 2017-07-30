<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V1 extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');

		$this->params = array(
			"{$this->name}/index:GET" => array(
				'money' => array('max' => 10 , 'min' => 1 , 'name' => '支付金额'),
				'paytype' => array('max' => 10 , 'min' => 1 , 'name' => '支付方法'),
				'active_url' => array('max' => 10 , 'min' => 1 , 'name' => '同步地址'),
				'notice_url' => array('max' => 10 , 'min' => 1 , 'name' => '异步地址'),
				'order_id' => array('max' => 32 , 'min' => 1 , 'name' => '商户编号'),
				'attribute' => array('max' => 216 , 'min' => 0 , 'name' => '附加属性'),
				'merchant_id' => array('max' => 16 , 'min' => 1 , 'name' => '商户ID'),
			),
			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			)
		);
	}

	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}


	/**
	 * 创建支付订单
	 * @return [type] [description]
	 */
	public function index(){
		$this->load->model('Order_model');
		$this->load->model('Passageway_model');
		$this->load->model('User_model');

		// 检查商户的订单号是否已经被创建过了
		if($this->Order_model->is_exist(array('merchant_order_id' => $this->params->order_id))){
			Autumn::end(false , '您输入的订单号已经存在');
		}

		// 检查输入的金额是否正确
		if( ! is_numeric($this->params->money) && ! is_float($this->params->money)){
			Autumn::end(false , '金额不正确');
		}else if(is_float($this->params->money)){
			$money = explode("." , $this->params->money);
			if(count($money[1]) > 2) Autumn::end(false , '金额不正确');
		}




		if( ! $this->User_model->is_exist(array('id' => $this->params->merchant_id))) Autumn::end(false , '无效的商户号');
		
		$Passageway_data = $this->Passageway_model->get(array('open' => 0 , 'name_key' => $this->params->paytype));
		if( ! $Passageway_data['id']) Autumn::end(false , '无效的支付方法');

		if( ! isset(json_decode($Passageway_data['value'])[1])){
			Autumn::end(false , '支付接口异常或未配置');
		}

		$data = json_decode(json_decode($Passageway_data['value'])[1] , true);

		if( ! isset($data['file']) || ! isset($data['function'])){
			Autumn::end(false , '支付接口异常');
		}

		if( ! method_exists($this->payment , $data['file'])) Autumn::end(false , '支付接口异常');

		$payment = $this->payment->$data['file']($data['function']);

		if($payment['state'] == false) Autumn::end(false , '支付接口异常');


		$this->Order_model->create(array(
			'from_user' => $this->params->merchant_id,
			'paytype' => $Passageway_data['id'],
			'money' => $this->params->money,
			'platform_order_id' => date('YmdHis') . rand(10000000 , 99999999),
			'merchant_order_id' => $this->params->order_id,
			'create_time' => date('Y-m-d H:i:s'),
			'notice_url' => $this->params->notice_url,
			'active_url' => $this->params->active_url,
			'attribute' => $this->params->attribute,
			'type' => 0,
		));

		Autumn::end(true , $payment);

	}
}

