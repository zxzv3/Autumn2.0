<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tools extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	// public function _remap($method , $data){
		// if(! Admin::is_login()) return;
		// $this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		// method_exists($this, $method) ? $this->$method($data) : show_404();
	// }



	public function create_table(){
		echo PHP_EOL;
	}
}

