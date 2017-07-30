<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('User_model');

		$this->params = array(
			"{$this->name}/login:POST" => array(
				'username' => array('min' => 6 , 'max' => 16 , 'name' => '用户名'),
				'password' => array('min' => 6 , 'max' => 16 , 'name' => '密码'),
			),
		);
	}



	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/home' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}




	/**
	 * 用户登录API接口
	 * @param username $[name] [<description>]
	 * @param password $[name] [<description>]
	 * @return [type] [description]
	 */
	public function login(){
		// sleep(1);
		$User_data = $this->User_model->get(array('username' => $this->params->username));
		if( ! $User_data['id']) Autumn::end(false , '您输入的用户名不存在，请检查后再试');

		$password = md5($this->params->password . $User_data['slat']);
		if($User_data['password'] == $password){
			$_SESSION['user'] = $User_data;

			$this->User_model->edit(array('id' => $User_data['id']) , array(
				'lost_time' => date('Y-m-d H:i:s'),
				'lost_ip' => $this->getIP(),
				'count' => $User_data['count'] + 1
			));
			Autumn::end(true);
		}
		Autumn::end(false , '您输入的密码不正确，请检查后再试');
	}

	public function getIP() { 
		if (getenv('HTTP_CLIENT_IP')) { 
			$ip = getenv('HTTP_CLIENT_IP'); 
		} 
		elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
			$ip = getenv('HTTP_X_FORWARDED_FOR'); 
		} 
		elseif (getenv('HTTP_X_FORWARDED')) { 
			$ip = getenv('HTTP_X_FORWARDED'); 
		} 
		elseif (getenv('HTTP_FORWARDED_FOR')) { 
			$ip = getenv('HTTP_FORWARDED_FOR'); 
		} 
		elseif (getenv('HTTP_FORWARDED')) { 
			$ip = getenv('HTTP_FORWARDED'); 
		} 
		else { 
			$ip = $_SERVER['REMOTE_ADDR']; 
		} 
		return $ip; 
	} 
}