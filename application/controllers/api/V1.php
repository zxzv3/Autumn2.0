<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V1 extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Order_model');
		$this->load->model('User_model');
		$this->load->model('Setting_model');
		$this->params = array(
			"{$this->name}/index:GET" => array(
				'money' => array('max' => 10 , 'min' => 1 , 'name' => '支付金额'),
				'paytype' => array('max' => 10 , 'min' => 1 , 'name' => '支付方法'),
				'active_url' => array('max' => 152 , 'min' => 1 , 'name' => '同步地址'),
				'notice_url' => array('max' => 152 , 'min' => 1 , 'name' => '异步地址'),
				'order_id' => array('max' => 32 , 'min' => 1 , 'name' => '商户订单号'),
				'attribute' => array('max' => 216 , 'min' => 0 , 'name' => '附加属性'),
				'merchant_id' => array('max' => 16 , 'min' => 1 , 'name' => '商户ID'),
			),
			"{$this->name}/test:GET" => array(
				'money' => array('max' => 10 , 'min' => 1 , 'name' => '支付金额'),
				'merchant_id' => array('max' => 16 , 'min' => 1 , 'name' => '商户ID'),
				'attribute' => array('max' => 216 , 'min' => 0 , 'name' => '附加属性'),
				'order_id' => array('max' => 32 , 'min' => 1 , 'name' => '商户订单号'),
				'sign' => array('max' => 32 , 'min' => 1 , 'name' => '校检值'),
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
	 * 接收异步通知
	 * @return [type] [description]
	 */
	public function notice(){

		$order_id = '2017073116081697225952';
		$money = '0.01';



		$reslut = $this->notice_merchant($order_id);
		var_dump($reslut);

		$message = array(
			0 => '您输入的订单号不存在',
			1 => '您输入的订单已经处理过了',
			2 => '您提供的金额和系统金额不符',
			3 => '抱歉，未能成功通知商户',
			4 => '订单的通知次数已达上限',
			5 => '通知并且支付成功'
		)[$reslut];
		echo $message;
	}





	/**
	 * 到账函数
	 * @param  [type] $order_id [description]
	 * @param  [type] $money    [description]
	 * @return [type]           [description]
	 */
	private function arrival($order_id , $money){


		log_message('debug' , "arrival order : {$order_id}");
		$Order_data = $this->Order_model->get(array('merchant_order_id' => $order_id , 'type' => 0));


		// 订单不存在
		if( ! isset($Order_data['id'])){
			log_message('debug' , "order non existent");
			return 0;
		}

		// 订单已经处理过了
		if($Order_data['type'] == '1'){
			log_message('debug' , "please do not repeat payment");
			return 1;
		}

		// 金额不正确
		if($Order_data['money'] != $money){
			log_message('debug' , "order non existent : {$order_id}");
			return 2;
		}


		$User_data = $this->User_model->get(array('id' => $Order_data['from_user']));

		

		// 到账处理
		$recorded = round($Order_data['money'] - (($Order_data['money'] / 100) * $Order_data['rate']) , 2);
		$this->User_model->edit(array('id' => $User_data['id']) , array(
			'money' => $User_data['money'] + $recorded
		));
		$this->Order_model->edit(array('id' => $Order_data['id']) , array(
			'type' => 1,
			'arrive_time' => date('Y-m-d H:i:s')
		));

		// 通知商户
		return $this->notice_merchant($order_id);
	}




	/**
	 * 通知商户
	 * @param  [type] $order_id [description]
	 * @return [type]           [description]
	 */
	private function notice_merchant($order_id){
		$Order_data = $this->Order_model->get(array('merchant_order_id' => $order_id , 'type' => 1));
		$User_data = $this->User_model->get(array('id' => $Order_data['from_user']));

		if($Order_data['notice'] == 1) return true;

		// 订单不存在
		if( ! isset($Order_data['id'])){
			log_message('debug' , "order non existent");
			return 0;
		}


		// 订单的通知次数已达上限
		if($Order_data['notice_count'] >= $this->Setting_model->item('merchantCount')){
			log_message('debug' , "order notice count max");
			return 4;
		}

		// 通知商户
		$params = array(
			'attribute' => $Order_data['attribute'],
			'money' => $Order_data['money'],
			'merchant_id' => $User_data['id'],
			'order_id' => $Order_data['merchant_order_id'],
			'sign' => md5($User_data['id'] . $Order_data['money'] . $Order_data['merchant_order_id'] . $User_data['merchant_key']),
		);
		$notice_url = $Order_data['notice_url'] . "?" . http_build_query($params);
		$reslut = @file_get_contents($notice_url);

		// 不论是否成功，都增加一次通知次数
		$this->Order_model->edit(array('id' => $Order_data['id']) , array(
			'notice_count' => $Order_data['notice_count'] + 1
		));

		if($reslut != 'success'){
			log_message('debug' , $notice_url);
			log_message('debug' , "failed to notify the merchant notice url");
			return 3;
		}else{
			$this->Order_model->edit(array('id' => $Order_data['id']) , array(
				'notice' => 1,
			));
			log_message('debug' , "success");
			return 5;
		}
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
		$this->params->money = (float) $this->params->money;


		if( ! is_numeric($this->params->money) && ! is_float($this->params->money)){
			Autumn::end(false , '金额不正确');
		}else if(is_float($this->params->money)){
			$money = explode("." , $this->params->money);
			if(strlen($money[1]) > 2 || $money[1] == '00') Autumn::end(false , '金额不正确');
		}





		if( ! $this->User_model->is_exist(array('id' => $this->params->merchant_id))) Autumn::end(false , '无效的商户号');
		
		$Passageway_data = $this->Passageway_model->get(array('open' => 0 , 'name_key' => $this->params->paytype));
		if( ! $Passageway_data['id']) Autumn::end(false , '该支付方法没有启用');

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


		// 计算出此次交易需要的手续费
		$value = json_decode($Passageway_data['value'] , true);

		$this->Order_model->create(array(
			'rate' => $value[5],
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

