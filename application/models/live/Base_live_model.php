<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_live_model extends CI_Model {
	public function __construct() {
	    parent::__construct();
	    $this->live = $this->load->database('live_turn_database', true);
	}

	public function get_like($where = array() , $link = array() , $select = array(), $page = 1, $count = 10){
		$this->live->where($where);
		if(count($link) >= 1){
			foreach ($link as $key => $value) {
				$this->live->like($key, $value);
			}
		}
		$this->live->limit($count , ($page - 1) * $count);
		return $this->live->select($select)->get($this->table_name)->result_array();
	}
	public function get_like_count($where = array() , $link = array() , $select = array(), $page = 1, $count = 10){
		$this->live->where($where);
		if(count($link) >= 1){
			foreach ($link as $key => $value) {
				$this->live->like($key, $value);
			}
		}
		$this->live->limit($count , ($page - 1) * $count);
		return $this->live->select($select)->count_all_results($this->table_name);
	}

	public function select_sum($string = 'id'){
		$this->live->select_sum($string);
		return $this;
	}
	public function group_by($data = array()){
		$this->live->group_by($data);
		return $this;
	}
	public function or_where($where = array()){
		$this->live->or_where($where);
		return $this;
	}
	public function where($where = array()){
		$this->live->where($where);
		return $this;
	}
	public function not_like($where = array()){
		$this->live->not_like($where);
		return $this;
	}



	

	public function edit($where = array() , $params = array()){
		$this->live->where($where)->update($this->table_name, $params);
		return $this->live->affected_rows() > 0;
	}

	
	public function remove($params = array()){
		return $this->live->delete($this->table_name , $params);
	}



	public function get_by($where = array(), $select = array() , $order_by = array('id' => 'desc')){
		foreach ($order_by as $key => $value) {
			$this->live->order_by($key , $value);
		}
		return $this->live->select($select)->where($where)->get($this->table_name, 1)->row_array();
	}
	public function get($where = array(), $select = array()){
		return $this->live->select($select)->where($where)->get($this->table_name, 1)->row_array();
	}

	public function get_list_by($params = array() , $page = 1 , $count = 10 , $select = array() , $is_all  = "Not all" , $order_by = array('id' => 'desc')){
		if($is_all === "Not all"){
			$paget = isset($_GET['page']) ? $this->input->get('page') : $page;
			$this->live->limit($count , ($page - 1) * $count);
		}
		foreach ($order_by as $key => $value) {
			$this->live->order_by($key , $value);
		}
		return $this->live->select($select)->get_where($this->table_name , $params)->result_array();
	}
	public function query($query){
		return $this->live->query($query);
	}

	public function get_list($params = array() , $page = 1 , $count = 10 , $select = array() , $is_all  = "Not all"){
		$page = isset($_GET['page']) ? $this->input->get('page' , true) : $page;
		if($is_all === "Not all"){
			$this->live->limit($count , ($page - 1) * $count);
		}
		return $this->live->select($select)->order_by('id' , 'desc')->get_where($this->table_name , $params)->result_array();
	}


	public function create_batch($params = array()){
		return $this->live->insert_batch($this->table_name , $params);
	}
	public function create($params = array()){
		$this->live->insert($this->table_name , $params);
		return $this->live->insert_id();
	}
	public function is_exist($where = array()) {
		return $this->live->select('id')->where($where)->get($this->table_name)->num_rows() > 0;
	}

	public function get_count($where = array()){
		return $this->live->where($where)->count_all_results($this->table_name);
	}
}
