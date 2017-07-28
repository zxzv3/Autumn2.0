<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');

		$this->params = array(
			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'username' => array('max' => 16 , 'min' => 2 , 'name' => '管理员帐号'),
				'password' => array('is_null' => true , 'max' => 16 , 'min' => 2 , 'name' => '管理员密码'),
				'group' => array('max' => 16 , 'min' => 1 , 'name' => '管理员群组'),
				'state' => array('max' => 16 , 'min' => 1 , 'name' => '管理员状态'),
			),
			"{$this->name}/create:POST" => array(
				'class' => array('max' => 16 , 'min' => 1 , 'name' => '文章栏目'),
				'title' => array('max' => 50 , 'min' => 2 , 'name' => '文章标题'),
				'keywords' => array('max' => 16 , 'min' => 1 , 'name' => '文章关键词'),
				'description' => array('max' => 220 , 'min' => 1 , 'name' => '文章描述'),
				'content' => array('max' => 10000 , 'min' => 1 , 'name' => '文章内容'),
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


	/**
	 * 创建一个文章
	 * @param title [<文章标题>]
	 * @param class [<文章所属栏目>]
	 * @param keywords [<文章关键词>]
	 * @param description [<文章描述>]
	 * @param content [<文章内容>]
	 */
	public function create(){
		$this->load->model('Article_model');
		$this->load->model('Class_model');

		if($this->Article_model->is_exist(array('title' => htmlspecialchars($this->params->title)))) Autumn::end(false , '您输入的标题文章已经存在');
		if( ! $this->Class_model->is_exist(array('id' => $this->params->class))) Autumn::end(false , '您输入的栏目不存在');
		

	}


}