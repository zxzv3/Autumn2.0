<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Passageway extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		

		$this->params = array(
			"{$this->name}/open:POST" => array(
				'id' => array('max' => 16 , 'min' => 1 , 'name' => 'id'),
				'value' => array('max' => 16 , 'min' => 1 , 'name' => '类型'),
			),
			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '权限组名称'),
				'type' => array('max' => 16 , 'min' => 1 , 'name' => '配置项类型'),
				'name_key' => array('max' => 26 , 'min' => 1 , 'name' => '调用方法名称'),
			),
			"{$this->name}/create:POST" => array(
				'name' => array('max' => 16 , 'min' => 2 , 'name' => '权限组名称'),
				'type' => array('max' => 16 , 'min' => 1 , 'name' => '配置项类型'),
				'name_key' => array('max' => 26 , 'min' => 1 , 'name' => '调用方法名称'),
			),
			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
			"{$this->name}/edit_item:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			)
			
		);
	}
    

	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}


	public function open(){
		$this->load->model('Passageway_model');
		if( ! $this->Passageway_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要修改的用户配置项不存在');
		}
		
		$Passageway_data = $this->Passageway_model->get(array('id' => $this->params->id));
		if($this->params->value == 0){
			if($this->Passageway_model->is_exist(array(
				'paytype' => $Passageway_data['paytype'] , 
				'open' => 0
			))){
				Autumn::end(false , '该支付类别下已经有开启的通道，请先关闭开启的通道');
			}
		}


		$this->Passageway_model->edit(array('id' => $this->params->id) , array(
			'open' => $this->params->value
		));
		Autumn::end(true);

	}


	/**
	 * 添加配置项目
	 * @param [type] $[name] [<description>]
	 * @param [type] $[type] [<description>]
	 * @param [type] $[from_group] [<description>]
	 * @param [type] $[name_key] [<description>]
	 * @param [type] $[valueSplit] [<description>]
	 * @return [type] [description]
	 */
	public function create(){
		$this->load->model('Passageway_model');

		if( ! in_array($this->params->type , array('input' , 'radio' , 'checkbox'))) $this->params->type = 'input';
		if($this->params->type != 'input' && (! isset($_POST['valueSplit']) || $this->input->post('valueSplit') == '')){
			Autumn::end(false , '您还没有输入配置项属性');
		}

		$valueSplit = explode(',', $this->input->post('valueSplit'));

		if($this->Passageway_model->is_exist(array('name' => $this->params->name))){
			Autumn::end(false , '您设置的配置项名称已重复');
		}


		// if($this->Passageway_model->is_exist(array('name_key' => $this->params->name_key))){
		// 	Autumn::end(false , '您设置的调用名称已经重复');
		// }


		$this->Passageway_model->create(array(
			'name' => $this->params->name,
			'paytype' => '未知',
			'type' => $this->params->type,
			'valueSplit' => json_encode($valueSplit),
			'name_key' => $this->params->name_key,
		));
		Autumn::end(true);
	}



	/**
	 * 修改配置项内容
	 * @return [type] [description]
	 */
	public function edit_item(){
		$this->load->model('Passageway_model');
		if( ! $this->Passageway_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要修改的用户配置项不存在');
		}


		$value = json_decode($this->input->post('value') , true);
		$this->Passageway_model->edit(array('id' => $this->params->id) , array(
			'value' => $this->input->post('value'),
			'paytype' =>  $value[0],
		));
		Autumn::end(true);
	}


	/**
	 * 编辑配置项目
	 * @param [type] $[name] [<description>]
	 * @param [type] $[type] [<description>]
	 * @param [type] $[from_group] [<description>]
	 * @param [type] $[name_key] [<description>]
	 * @param [type] $[valueSplit] [<description>]
	 * @return [type] [description]
	 */
	public function edit(){
		$this->load->model('Passageway_model');

		if( ! in_array($this->params->type , array('input' , 'radio' , 'checkbox'))) $this->params->type = 'input';
		if($this->params->type != 'input' && (! isset($_POST['valueSplit']) || $this->input->post('valueSplit') == '')){
			Autumn::end(false , '您还没有输入配置项属性');
		}

		$valueSplit = explode(',', $this->input->post('valueSplit'));
		

		// // 如果没有设置关联权限组则直接检查是重名
		// if($this->Passageway_model->is_exist(array(
		// 	'id !=' => $this->params->id,
		// 	'name_key' => $this->params->name_key
		// ))){
		// 	Autumn::end(false , '您设置的调用名称已经重复');
		// }
		
		$this->Passageway_model->edit(array('id' => $this->params->id) , array(
			'name' => $this->params->name,
			'type' => $this->params->type,
			'valueSplit' => json_encode($valueSplit),
			'name_key' => $this->params->name_key,
		));
		Autumn::end(true);
	}

	/**
	 * 删除配置项
	 * @return [type] [description]
	 */
	public function remove(){
		$this->load->model('Passageway_model');

		if( ! $this->Passageway_model->is_exist(array('id' => $this->params->id))){
			Autumn::end(false , '您要删除的用户配置项不存在');
		}

		$this->Passageway_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}



}