<?php
/**
 * @name : Notice.php
 * @description : 用于消息通知页面的API
 * @updateTime : 2017年7月27日 22:34
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Notice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('User_group_model');
		

		$this->params = array(

			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'title' => array('max' => 50 , 'min' => 2 , 'name' => '消息标题'),
			),

			"{$this->name}/create:POST" => array(
				'title' => array('max' => 50 , 'min' => 2 , 'name' => '消息标题'),
				'type' => array('max' => 21 , 'min' => 2 , 'name' => '类型'),
				'from_user' => array('max' => 16 , 'min' => 1 , 'name' => '所属用户'),
			),
			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
			"{$this->name}/getcontent:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
		);
	}
    

	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}


	/**
	 * 获通知的内容
	 * @return [type] [<description>]
	 */
	public function getcontent(){
		$this->load->model('Notice_model');
		if( ! $this->Notice_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '对应的数据不存在');
		}
		$data = $this->Notice_model->get(array('id' => $this->params->id));
		Autumn::end(true , htmlspecialchars_decode($data['content']));
	}


	/**
	 * 创建一个新的通知或者私信
	 * @return [type] [description]
	 */
	public function create(){
		$this->load->model('User_model');
		$this->load->model('Notice_model');
		$type = $this->params->type == 'notice' ? 'notice' : 'letter';
		$content = strip_tags(htmlspecialchars($this->input->post('content' , true)) , '<p><b><span><a><table><tr><td><h1><h2><h3><h4><h5><h6><font><strong><video><img>');
		if(strlen(strip_tags($content)) > 5000) Autumn::end(false , '文章内容大于5000字');
		if(strlen(strip_tags($content)) < 3) Autumn::end(false , '文章内容少于2个字');

		if($type == 'letter'){
			if( ! $this->User_model->is_exist(array('id' => $this->params->from_user))){
				Autumn::end(false , '对应的用户ID不存在');
			}
		}else{
			$this->params->from_user = -1;
		}
		$this->Notice_model->create(array(
			'type' => $type,
			'title' => $this->params->title,
			'content' => $content,
			'from_user' => $this->params->from_user,
			'create_time' => date('Y-m-d H:i:s')
		));
		Autumn::end(true);
	}



	/**
	 * 删除通知的数据
	 * @return [type] [description]
	 */
	public function remove(){
		$this->load->model('Notice_model');
		if( ! $this->Notice_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要删除的数据不存在');
		}
		$this->Notice_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}


	/**
	 * 编辑消息或者通知的数据
	 * @return [type] [description]
	 */
	public function edit(){
		$this->load->model('User_model');
		$this->load->model('Notice_model');

		if( ! $this->Notice_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要编辑的数据不存在');
		}
		$Notice_data = $this->Notice_model->get(array('id' => $this->params->id));


		$type = $Notice_data['type'];
		$content = strip_tags(htmlspecialchars($this->input->post('content')) , '<p><b><span><a><table><tr><td><h1><h2><h3><h4><h5><h6><font><strong><video><img>');
		if(strlen(strip_tags($content)) > 5000) Autumn::end(false , '文章内容大于5000字');
		if(strlen(strip_tags($content)) < 3) Autumn::end(false , '文章内容少于2个字');

		if($type == 'letter'){
			if( ! $this->User_model->is_exist(array('id' => $this->params->from_user))){
				Autumn::end(false , '对应的用户ID不存在');
			}
		}else{
			$this->params->from_user = -1;
		}
		$this->Notice_model->edit(array('id' => $Notice_data['id']) , array(
			'title' => $this->params->title,
			'content' => $content,
			'from_user' => $this->params->from_user,
		));
		Autumn::end(true);
	}

}