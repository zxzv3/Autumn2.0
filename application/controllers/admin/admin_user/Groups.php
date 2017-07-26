<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Groups extends CI_Controller {

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

		$this->load->model('Admin_user_model');
		$this->load->model('Admin_group_model');

		$Group_list = $this->Admin_group_model->get_list_by(array() , 1 , 10 ,  array() , "Not all" , $order_by = array('id' => 'asc'));
		foreach ($Group_list as &$value) {
			$value['people'] = $this->Admin_user_model->get_count(array('from_group' => $value['id']));

			$value['group_state'] = $value['id'] == '1' ? 'danger' : '';
			$limitText = '';

			$value['data'] = json_encode($value);

			$limitConfig = $this->config->item('admin_jurisdiction');

			if($value['limit'] != 'all'){
				$limit = json_decode($value['limit'] , true);
				if(count($limit) > 0 && is_array($limit)){
					foreach ($limitConfig as $limitKey => $limitValue) {
						foreach ($limit as $limitValue_text) {
							$type = array_search($limitValue_text , $limitValue);
							if($type != false){
								$limitText .= '<span class="label fl" style="font-size:13px;margin:0px 7px 8px 0;">' . $limitKey . $type . '</span>';
							}						
						}
					}
				}
				$value['limit_trun'] = $limitText;
			}else{
				$value['limit_trun'] = '全部权限';
			}

		}
		Loader::view(array('admin_user/groups') , array(
			'Group_list' => $Group_list
		) , ADMIN_TEMPLATE);
	}
}

