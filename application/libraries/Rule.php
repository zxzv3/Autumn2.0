<?php
class Rule{
	public static $reslut = array();
	public static $reslut_other = array();
	public static $toast_message = array(
		"header" => '您输入的' , 
		"rule" => array(
			"min" => '不能少于' ,
			"max" => '不能大于' ,
			"null" => '不能为空' ,
			"error" => '规则不正确' ,
			"not_equal" => '不正确' ,
		) , 
		"sum" => '位字符',
		"footer" => ''
	);


	/**
	 * 检查用户输入的规范数据
	 * @param  array  $data [description]
	 * @param  array  $rule [description]
	 * @return [type]       [description]
	 */
	public static function check($data = array() , $rule = array() , $type = false){
		$index = 0;
		$success = true;
		self::$reslut = array();
		self::$reslut_other = array();
		// if(count($data) != count($rule)) 
		foreach ($data as $key => $value) {
			$length = @iconv_strlen($value);
			if(isset($rule[$key])){
				$this_rule = $rule[$key];
				$this_name = self::$toast_message['header'] . $this_rule['name'];

				if( ! isset($this_rule['htmlspecialchars'])){
					$data[$key] = htmlspecialchars($value);
				}

				if(isset($this_rule['is_null']) && $this_rule['is_null'] == true){
					$success = true;
					
				}else if(isset($this_rule['is_equal']) && $value != $this_rule['is_equal']){
					self::_reslutFormat($this_name . self::$toast_message['rule']['not_equal']);
					$success = false;

				}else if(isset($this_rule['is_number']) && $this_rule['is_number'] == true && ( ! is_numeric($value)  || (isset($this_rule['min']) && $value < $this_rule['min']) || (isset($this_rule['max']) && $value > $this_rule['max']) )){
					self::_reslutFormat($this_name . self::$toast_message['rule']['error']);
					$success = false;

				}else if(isset($this_rule['is_null']) && $this_rule['is_null'] == true &&  $length == 0){
					self::_reslutFormat($this_name . self::$toast_message['rule']['null']);
					$success = false;

				}else if(isset($this_rule['min']) && $length < $this_rule['min']){
					self::_reslutFormat($this_name . self::$toast_message['rule']['min'] . $this_rule['min'] . self::$toast_message['sum']);
					$success = false;
					
				}else if(isset($this_rule['max']) && $length > $this_rule['max']){
					self::_reslutFormat($this_name . self::$toast_message['rule']['max'] . $this_rule['max'] . self::$toast_message['sum']);
					$success = false;
				}
				$index ++;
			}
		}

		self::$reslut_other = $data;
		if( ! $success && $type){
			Autumn::end(false , self::$reslut['text']);
		}
		return $success;
	}


	/**
	 * 通用用户输入规则检测
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	private static function _rule($name){
		switch ($name) {
			case 'phone':break;
			case 'email':break;
			case 'idcard':break;
			case 'username':break;
			case 'password':break;
		}
	}


	/**
	 * 通用结果返回方法
	 * @param  [type] $text  [description]
	 * @param  array  $other [description]
	 * @return [type]        [description]
	 */
	private static function _reslutFormat($text , $other = array()){
		self::$reslut = array(
			"text" => $text . self::$toast_message['footer'], 
			"other" => isset($other) ? $other : array()
		);
	}


	/**
	 * 获取规则文件处理的结果
	 * @return [type] [获取规则文件处理的结果，返回array，若已通过规则检测则返回true]
	 */
	public static function reslut(){
		if( ! self::$reslut_other == array()) return self::$reslut_other;
		return self::$reslut;
	}




}