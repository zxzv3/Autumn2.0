<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lists extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
	}

	public function _remap($method){
		if(! Admin::is_login()) return;
		$this->params = Autumn::params("{$this->name}/{$method}" , ADMINDIR);
		method_exists($this, $method) ? $this->$method() : show_404();
	}



	public function index(){
		$this->load->model('User_model');
		$this->load->model('Notice_model');
		$Notice_list = $this->Notice_model->get_list(array());
		foreach ($Notice_list as &$value) {
			$data = $value;
			unset($data['content']);
			$value['data'] = json_encode($data);
			$value['type'] = array(
				'notice' => '<span class="label success">消息</span>',
				'letter' => '<span class="label fzocms">私信</span>'
			)[$value['type']];

			if($value['from_user'] == -1){
				$value['from_user'] = '<span class="label">群发消息</span>';
			}else{
				$User_data = $this->User_model->get(array('id' => $value['from_user']));
				$value['from_user'] = '<span class="label fezocms">' . $User_data['username'] . '</span>';
			}

			$value['content'] = mb_substr(strip_tags(htmlspecialchars_decode($value['content'])), 0 , 40) . '.....';
		}
		Loader::view(array('notice/lists') , array(
			'Notice_list' => $Notice_list,
		) , ADMIN_TEMPLATE);
	}
}

