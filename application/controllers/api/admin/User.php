<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('User_model');

		$this->params = array(
			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'username' => array('max' => 16 , 'min' => 2 , 'name' => '管理员帐号'),
				'password' => array('is_null' => true , 'max' => 16 , 'min' => 2 , 'name' => '管理员密码'),
				'group' => array('max' => 16 , 'min' => 1 , 'name' => '管理员群组'),
				'state' => array('max' => 16 , 'min' => 1 , 'name' => '管理员状态'),
			),
			"{$this->name}/create:POST" => array(
				'username' => array('max' => 16 , 'min' => 2 , 'name' => '管理员帐号'),
				'password' => array('max' => 16 , 'min' => 2 , 'name' => '管理员密码'),
				'group' => array('max' => 16 , 'min' => 1 , 'name' => '管理员群组'),
				'state' => array('max' => 16 , 'min' => 1 , 'name' => '管理员状态'),
			),
			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
			"{$this->name}/login:POST" => array(
				'username' => array('min' => 6 , 'max' => 16 , 'name' => '用户名'),
				'password' => array('min' => 6 , 'max' => 16 , 'name' => '密码'),
			),
		);
	}


	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}


	public function remove(){
		$this->load->model('User_model');
		$this->load->model('User_group_model');

		if( ! $this->User_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的用户名不存在');
		$this->User_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}


	/**
	 * 编辑用户信息
	 * @param  $[name] [<description>]
	 * @return [type] [description]
	 */
	public function edit(){
		$this->load->model('User_model');
		$this->load->model('User_group_model');
		if( ! $this->User_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的用户名不存在');
		$User_data = $this->User_model->get(array('id' => $this->params->id));
	
		if($this->params->password != ''){
			$slat = rand(100000 , 999999);
			$password = md5($this->params->password . $slat);
		}else{
			$password = $User_data['password'];
			$slat = $User_data['slat'];
		}


		$this->User_model->edit(array('id' => $this->params->id) , array(
			'username' => $this->params->username,
			'from_group' => $this->params->group,
			'state' => $this->params->state,
			'password' => $password,
			'slat' => $slat,
		));
		Autumn::end(true);
	}





	public function create(){
		$this->load->model('User_model');
		$this->load->model('User_group_model');
		if($this->User_model->is_exist(array('username' => $this->params->username))) Autumn::end(false , '您输入的用户名已经存在');
		if( ! $this->User_group_model->is_exist(array('id' => $this->params->group))) Autumn::end(false , '您选择的权限组不存在');

		$slat = rand(100000 , 999999);
		$this->User_model->create(array(
			'username' => $this->params->username,
			'password' => md5($this->params->password . $slat),
			'slat' => $slat,
			'from_group' => $this->params->group,
			'state' => $this->params->state,
		));
		Autumn::end(true);
	}

	/**
	 * 后台管理员登录
	 * @return [type] [description]
	 */
	public function login(){
		$User_data = $this->User_model->get(array('username' => $this->params->username));
		if( ! $User_data['id']) Autumn::end(false , '您输入的用户名不存在');

		$password = md5($this->params->password . $User_data['slat']);
		if($User_data['password'] == $password){
			$_SESSION['admin_user'] = $User_data;

			$this->User_model->edit(array('id' => $User_data['id']) , array(
				'lost_time' => date('Y-m-d H:i:s'),
				'lost_ip' => $this->getIP(),
				'count' => $User_data['count'] + 1
			));
			Autumn::end(true);
		}
		Autumn::end(false , '您输入的密码不正确');
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