<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classe extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		

		$this->params = array(

			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '栏目名称'),
				'description' => array('max' => 500 , 'min' => 1 , 'name' => '栏目描述'),
				'view' => array('max' => 100 , 'min' => 1 , 'name' => '调用模板'),
			),


			"{$this->name}/create:POST" => array(
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '栏目名称'),
				'description' => array('max' => 500 , 'min' => 1 , 'name' => '栏目描述'),
				'view' => array('max' => 100 , 'min' => 1 , 'name' => '调用模板'),
				'type' => array('max' => 100 , 'min' => 1 , 'name' => '类型'),
			),


			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
			"{$this->name}/edit_item:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'value' => array('max' => 126 , 'min' => 2 , 'name' => '内容'),
			)
			
		);
	}
    

	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	/**
	 * 编辑栏目内容
	 * @return [type] [description]
	 */
	public function edit(){
		$this->load->model('Class_model');
		if( ! $this->Class_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的栏目不存在');
		$this->Class_model->edit(array('id' => $this->params->id) , array(
			'name' => $this->params->name,
			'description' => $this->params->description,
			'view' => $this->params->view,
		));
		Autumn::end(true);
	}

	

	/**
	 * 创建栏目
	 * @return [type] [description]
	 */
	public function create(){
		$this->load->model('Class_model');

		// 创建顶级栏目
		if($this->params->type == 'topid'){
			if($this->Class_model->is_exist(array('topid' => 0 , 'name' => $this->params->name))) Autumn::end(false , '您输入的栏目名称已经存在');
			$id = $this->Class_model->create(array(
				'topid' => 0,
				'level' => 0,
				'name' => $this->params->name,
				'description' => $this->params->description,
				'view' => $this->params->view,
			));
			$this->Class_model->edit(array('id' => $id) , array('path' => $id));
		}


		// 创建子栏目
		if($this->params->type == 'songid'){
			$topid = htmlspecialchars($this->input->post('topid' , true));

			$Topid_data = $this->Class_model->get(array('id' => $topid));
			if( ! isset($Topid_data['id'])) Autumn::end(false , '您输入的顶级栏目不存在');
			if($this->Class_model->is_exist(array('topid' => $topid , 'name' => $this->params->name))) Autumn::end(false , '您输入的栏目名称已经存在');

			$id = $this->Class_model->create(array(
				'name' => $this->params->name,
				'view' => $this->params->view,
				'topid' => $Topid_data['id'],
				'level' => $Topid_data['level'] + 1,
				'description' => $this->params->description,
			));
			$this->Class_model->edit(array('id' => $id) , array('path' => $Topid_data['path'] . ',' . $id));
		}

		Autumn::end(true);
	}







	/**
	 * 删除栏目
	 * @return [type] [description]
	 */
	public function remove(){
		$this->load->model('Class_model');
		if( ! $this->Class_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要删除的数据不存在');
		}

		$Class_data = $this->Class_model->get(array('id' => $this->params->id));

		if($this->Class_model->get_count(array(
			'topid' => $this->params->id
		)) > 0) Autumn::end(false , '您无法删除该栏目，因为该栏目不为空，请先删除该栏目下的子栏目');

		$this->Class_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}



}