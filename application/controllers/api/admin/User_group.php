<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_group extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('User_group_model');
		

		$this->params = array(

			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '权限组名称'),
			),
			"{$this->name}/create:POST" => array(
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '权限组名称'),
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



	public function remove(){
		if( ! $this->User_group_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要删除的权限组不存在');
		}


		$this->load->model('Admin_user_model');
		$this->Admin_user_model->edit(array('from_group' => $this->params->id) , array(
			'from_group' => -1
		));

		$this->User_group_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}



	public function edit(){
		$limit = $this->input->post('limit');
		if(count($limit) <= 0) Autumn::end(false , '您输入的允许权限不完整');
		$User_group_data = $this->User_group_model->get(array('id' => $this->params->id));


		if($this->User_group_model->is_exist(array(
			'id' != $this->params->id ,
			'name' => $this->params->name
		))){
			Autumn::end(false , '您输入的权限组名称已经存在');
		}

		$this->User_group_model->edit(array('id' => $this->params->id) , array(
			'name' => $this->params->name,
			'limit' => json_encode($limit),
			'create_time' => date('Y-m-d H:i:s')
		));
		Autumn::end(true);
	}

	public function create(){
		$limit = $this->input->post('limit');
		if(count($limit) <= 0) Autumn::end(false , '您输入的允许权限不完整');
		if($this->User_group_model->is_exist(array( 'name' => $this->params->name ))){
			Autumn::end(false , '您输入的权限组名称已经存在');
		}

		$this->User_group_model->create(array(
			'name' => $this->params->name,
			'limit' => json_encode($limit),
			'create_time' => date('Y-m-d H:i:s')
		));
		Autumn::end(true);
	}
}