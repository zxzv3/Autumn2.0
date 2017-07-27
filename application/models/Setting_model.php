<?php 
include_once APPPATH . 'models/Base_model.php';
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends Base_model {
	public function __construct() {
	    parent::__construct();
	    $this->table_name = 'setting';
	}



	public function item($key = ''){
		$data = $this->get(array('name_key' => $key));
		return $data['value'];
	}
}