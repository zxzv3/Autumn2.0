<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_model extends CI_Model {
	public function __construct() {
	    parent::__construct();
	}

	public function get_like($where = array() , $link = array() , $select = array(), $page = 1, $count = 10){
		$this->db->where($where);
		if(count($link) >= 1){
			foreach ($link as $key => $value) {
				$this->db->like($key, $value);
			}
		}
		$this->db->limit($count , ($page - 1) * $count);
		return $this->db->select($select)->get($this->table_name)->result_array();
	}
	public function get_like_count($where = array() , $link = array() , $select = array(), $page = 1, $count = 10){
		$this->db->where($where);
		if(count($link) >= 1){
			foreach ($link as $key => $value) {
				$this->db->like($key, $value);
			}
		}
		$this->db->limit($count , ($page - 1) * $count);
		return $this->db->select($select)->count_all_results($this->table_name);
	}

	public function select_sum($string = 'id'){
		$this->db->select_sum($string);
		return $this;
	}
	public function group_by($data = array()){
		$this->db->group_by($data);
		return $this;
	}
	public function or_where($where = array()){
		$this->db->or_where($where);
		return $this;
	}
	public function where($where = array()){
		$this->db->where($where);
		return $this;
	}
	public function not_like($where = array()){
		$this->db->not_like($where);
		return $this;
	}



	

	public function edit($where = array() , $params = array()){
		$this->db->where($where)->update($this->table_name, $params);
		return $this->db->affected_rows() > 0;
	}

	
	public function remove($params = array()){
		return $this->db->delete($this->table_name , $params);
	}



	public function get_by($where = array(), $select = array() , $order_by = array('id' => 'desc')){
		foreach ($order_by as $key => $value) {
			$this->db->order_by($key , $value);
		}
		return $this->db->select($select)->where($where)->get($this->table_name, 1)->row_array();
	}
	public function get($where = array(), $select = array()){
		return $this->db->select($select)->where($where)->get($this->table_name, 1)->row_array();
	}

	public function get_list_by($params = array() , $page = 1 , $count = 10 , $select = array() , $is_all  = "Not all" , $order_by = array('id' => 'desc')){
		if($is_all === "Not all"){
			$paget = isset($_GET['page']) ? $this->input->get('page') : $page;
			$this->db->limit($count , ($page - 1) * $count);
		}
		foreach ($order_by as $key => $value) {
			$this->db->order_by($key , $value);
		}
		return $this->db->select($select)->get_where($this->table_name , $params)->result_array();
	}
	public function query($query){
		return $this->db->query($query);
	}

	public function get_list($params = array() , $page = 1 , $count = 10 , $select = array() , $is_all  = "Not all"){
		$page = isset($_GET['page']) ? $this->input->get('page' , true) : $page;
		if($is_all === "Not all"){
			$this->db->limit($count , ($page - 1) * $count);
		}
		return $this->db->select($select)->order_by('id' , 'desc')->get_where($this->table_name , $params)->result_array();
	}


	public function create_batch($params = array()){
		return $this->db->insert_batch($this->table_name , $params);
	}
	public function create($params = array()){
		$this->db->insert($this->table_name , $params);
		return $this->db->insert_id();
	}
	public function is_exist($where = array()) {
		return $this->db->select('id')->where($where)->get($this->table_name)->num_rows() > 0;
	}

	public function get_count($where = array()){
		return $this->db->where($where)->count_all_results($this->table_name);
	}
}
