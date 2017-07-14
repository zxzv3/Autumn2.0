<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_user extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');
	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$method = strtolower($method);
		$this->params = Autumn::params("{$this->name}/{$method}" , 'Api/Admin');
		if( ! in_array($method , get_class_methods($this))) show_404();
		$this->$method();
	}



	/**
	 * 后台管理员登录
	 * @return [type] [description]
	 */
	public function login(){
		$User_data = $this->Admin_user_model->get(array('username' => $this->params->username));
		if( ! $User_data['id']) Autumn::end(false , '您输入的用户名不存在');

		$password = md5($this->params->password . $User_data['slat']);
		if($User_data['password'] == $password){
			$_SESSION['admin_user'] = $User_data;
			Autumn::end(true);
		}
		Autumn::end(false , '您输入的密码不正确');
	}
}