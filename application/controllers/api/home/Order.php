<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('User_model');

		$this->params = array(
			"{$this->name}/check:POST" => array(
				'id' => array('min' => 1 , 'max' => 16 , 'name' => '索引'),
			),
		);
	}


	public function _remap($method){
		if( ! Autumn::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/home' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function check(){
		$this->load->model('Order_model');
		$this->load->model('User_model');
		if( ! $this->Order_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的订单不存在');

		$Order_data = $this->Order_model->get(array('id' => $this->params->id));
		if($Order_data['from_user'] != $_SESSION['user']['id']) Autumn::end(false , '这不是属于你的订单');
		if($Order_data['type'] == 1) Autumn::end(false , '请勿重复通知');
		
		
		$User_data = $this->User_model->get(array('id' => $Order_data['from_user']));


		$params = array(
			'attribute' => $Order_data['attribute'],
			'money' => $Order_data['money'],
			'merchant_id' => $User_data['id'],
			'order_id' => $Order_data['merchant_order_id'],
			'sign' => md5($User_data['id'] . $Order_data['money'] . $Order_data['merchant_order_id'] . $User_data['merchant_key']),
		);
		$notice_url = $Order_data['notice_url'] . "?" . http_build_query($params);
		$reslut = @file_get_contents($notice_url);
		if($reslut != 'success'){
			Autumn::end(false , '未能成功通知商户，通知地址无法访问，或没有返回数据' );
		}



		$this->Order_model->edit(array('id' => $this->params->id) , array(
			'type' => 0,
			'notice' => 1,
		));
		Autumn::end(true);
	}


}