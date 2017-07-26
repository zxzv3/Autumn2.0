<?php
/**
 * Loader 加载网站的视图
 * Create Time : 2016年10月29日 09:40:15
 * Update Time : 2016年10月29日 09:40:30
 */
class Loader{
	static public $CI;
	public function __construct(){
		self::$CI = & get_instance();
	}




	/**
	 * 全自动加载页面视图
	 * @param  array   $view_path [description]
	 * @param  array   $push_data [description]
	 * @param  string  $view_type [description]
	 * @param  boolean $print     [description]
	 * @return [type]             [description]
	 */
	static public function view($view_path = array() , $push_data = array() , $view_type = 'admin' , $print = true){
		$view = '';
		$config_list = array_merge(self::$CI->config->item('autumn') , $push_data);
		$view .= self::$CI->parser->parse($view_type . '/template/header' , $config_list , $print);
		foreach ($view_path as $path) {
			$view .= self::$CI->parser->parse($view_type . '/' . $path , array_merge($config_list , $push_data) , $print);
		}
		if($print){
			echo $view;
		}else{
			return $view;
		}
	}
}