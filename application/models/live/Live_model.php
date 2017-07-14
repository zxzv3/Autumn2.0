<?php 
include_once APPPATH . 'models/live/Base_live_model.php';
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Live_model extends Base_live_model {
	public function __construct() {
	    parent::__construct();
	    $this->table_name = 'jy_video';
	}

}