
var ruleWidget = (function(){
	var public = function(){} , 
		reslut = {} , 
		success = true , 
		toastText = {
			header : '您输入的' , 
			rule : {
				min : '不能少于' ,
				max : '不能大于' ,
				null : '不能为空' ,
				error : '规则不正确' ,
			} , 
			sum : '位字符',
			footer : ''
		};
	public.prototype.set = function(option){
		$.extend(toastText, option);
	}
	public.prototype.check = function(data , rule){
		reslut = {} , success = true;
		// if(getPropertyCount(data) != getPropertyCount(rule)){
		// 	return false;
		// }
		var index = 0;
		var params = {};
		$.each(data , function(key , value){

			if(key == 'target') return;
			params[key] = value;
			var length = value.length;
			var thisRule = rule[key];

			if(typeof thisRule == 'undefined' || typeof thisRule['name'] == 'undefined') return;
			var thisName = toastText.header + thisRule.name;


			if(isset(thisRule.is_null) && thisRule.is_null == false){

				success = true;
			}else if(isset(thisRule.is_null) && thisRule.is_null == true &&  length == 0){
				_reslutFormat(thisName + toastText.rule.null , thisRule.other)
				success = false;
			}else if(isset(thisRule.min) && length < thisRule.min){
				_reslutFormat(thisName + toastText.rule.min + thisRule.min + toastText.sum , thisRule.other)
				success = false;
			}else if(isset(thisRule.max) && length > thisRule.max){
				_reslutFormat(thisName + toastText.rule.max + thisRule.max + toastText.sum , thisRule.other)
				success = false;
			}else if(isset(thisRule.is_number) && thisRule.is_number == true &&  (! isNaN(rule[key]) || value < thisRule.number_min || value > thisRule.number_max )){
				_reslutFormat(thisName + toastText.rule.error , thisRule.other)
				success = false;
			}

			if(isset(thisRule.rule)){
				switch(thisRule.rule){
					case 'phone' :
					break;
					case 'email' :
					break;
					case 'idcard' :
					break;
					case 'username' :
					break;
					case 'password' :
					break;
					case 'NaN' :
					break;
				}
				if( ! success) return false;
			}
			if( ! success) return false;
		});
		return success ? params : false;
	}
	public.prototype.reslut = function(){
		return reslut;
	}


	function _reslutFormat(text , other){
		reslut = {
			text : text , 
			other : typeof other != 'undefined' ? other : {}
		}
	}
	function isset(context){
		return typeof context != 'undefined';
	}

	return public;
})(jQuery);

