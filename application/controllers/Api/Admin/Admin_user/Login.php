<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function _remap($method){
		$method = strtolower($method);
		$this->params = Autumn::params("Home/{$method}" , ADMINDIR);
		if( ! in_array($method , get_class_methods($this))) show_404();
		$this->$method();
	}


	public function index(){
		
	}
}