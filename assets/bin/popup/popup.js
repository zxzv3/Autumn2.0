

var popupWidget = (function(){
	var public = function(){} , 
		$parent , _self = {} , clearTime = 0 , $thisSure , public_sure_params ,
		dom = new Dom();


	_self._init = function(){
		return $('body').append('<div class="popup" id="js-popup"></div>').find("#js-popup");
	}
	_self._check = function(domName , idName){
		if($parent.find(idName).html() == undefined){
			return $parent.append(dom.get(domName)).find(idName);
		}else{
			$('#js-popup ' + idName).remove().empty();
			return $parent.append(dom.get(domName)).find(idName);
		}
	}

	_self.close = function(){
		$thisSure.find('.popup-sure').removeClass('in');
		$thisSure.find('.popup-sure').addClass('close');
		setTimeout(function(){
			$thisSure.fadeOut(200)
		} , 100)
	}



	/**
	 * 获得表单中的带有name属性的所有value
	 * @return {[type]} [description]
	 */
	_self.sure_getFromData = function(){
		var params = {params : {} , target : {}};
		$thisSure.find(".popup-sure-content [name]").each(function(key , value){
			params.params[$(value).attr('name')] = $(value).attr('data-value') == '' || $(value).attr('data-value') == undefined ? $(value).val() : $(value).attr('data-value');
			params.target[$(value).attr('name')] = $(value)
		});
		return params;
	}



	/**
	 * 隐藏掉弹窗底部按钮
	 * @param  {[type]} value [description]
	 * @return {[type]}       [description]
	 */
	public.prototype.hideBottom = function(value){
		$thisSure = $('#js-popup-sure');
		$thisSure.find(".popup-sure-bottom").empty().remove()
		return this;
	}

	/**
	 * 替换掉底部按钮
	 * @param  {[type]} value [description]
	 * @return {[type]}       [description]
	 */
	public.prototype.replaceBottom = function(value){
		$thisSure = $('#js-popup-sure');
		$thisSure.find(".popup-sure-bottom").html(value)
		return this;
	}




	var time = 0;
	public.prototype.toast = function(value){
		clearTimeout(time)
		$thisToast_ = _self._check('popup_toast' , '#js-toast').show();
		$thisToast_.removeClass('close').addClass('open').find('p').text(value);
		time = setTimeout(function(){
			$thisToast_.removeClass('open').addClass('close');
			setTimeout(function(){
				$thisToast_.removeClass('close').hide();
			} , 900)		
		} , 2000)		
	}


	public.prototype.sure = function(params){
		var public_sure_params = params;
		var popupStyle = isset(params.popupStyle) ? params.popupStyle : 'popup_sure';
		$thisSure = _self._check(popupStyle , '#js-popup-sure');
		$thisSure.find(".popup-sure").removeAttr('style')

		isset(params.style) ? $thisSure.find(".popup-sure").css(params.style) : '';

		$thisSure.find('h1').html(params.title)
		$thisSure.unbind('click')
		$thisSure.find('.popup-sure-content').html(params.content)
		$thisSure.fadeIn(0).on('click', '#js-close', function(event) {
			_self.close();
		}).find('.popup-sure').removeClass('close').addClass('in');

		// 给select的option选中单项
		$thisSure.find('select').each(function(key , value){
			var selectValue = $(value).attr('value');
			$(value).find('option[value="' + selectValue + '"]').attr('selected' , true)
		});
		return this;
	}

	/**
	 * sure 方法返回数据
	 * @param  {[type]} fun1 [description]
	 * @param  {[type]} fun2 [description]
	 * @return {[type]}      [description]
	 */
	public.prototype.then = function(fun1 , fun2){
		var $button = $thisSure.find('.popup-sure-bottom button');
		$thisSure.find('.popup-sure-bottom').unbind('click')
		$thisSure.find('.popup-sure-bottom').on('click', 'button', function(event) {
			var buttonIndex = $button.index(this);
			var target = this;
			var params = {
				popup : $thisSure ,
				fromData : _self.sure_getFromData() ,
				target : target ,
				rule : {
					state : true , 
				}
			};
			_self.inputToastClose();
			if(buttonIndex == 0){
				var $button_success = $(this);
				// button.loading($button_success);

				// 处理用户输入规范检测
				if(isset(public_sure_params) && isset(public_sure_params.rule)){
					$.each(params.fromData.target , function(key , value){
						public_sure_params.rule[key].other = value;
					});
					if(rule.check(params.fromData.params , public_sure_params.rule) == false){
						params.rule = {
							state : false , 
							data : rule.reslut()
						}
						// button.reLoading($button_success);
						popup.inputToast(params.rule.data.text , params.rule.data.other);
						return false;
					}
				}

				// 处理窗口API事件
				if(isset(public_sure_params) && isset(public_sure_params.api) && params.rule.state){
					public_sure_params.api[0][public_sure_params.api[1]](params.fromData.params).then(function(data){
						params.api = {
							state : true , 
							data : data
						}
						startFunctionOne(params);
					}, function(error){
						params.api = {
							state : false , 
							data : error
						}
						startFunctionOne(params);
					});
				}else{
					startFunctionOne(params);
				}


				function startFunctionOne(params , $this){
					var functionOnc = fun1(params);
					functionOnc = false;
					if(functionOnc){
						_self.close();
						return false;
					}
					// if( ! functionOnc || typeof functionOnc == 'undefined') button.reLoading($button);
				}



			}else if(buttonIndex == 1 && typeof fun2 != 'undefined'){
				if(fun2(params) == false) return false;
			}
		});
	}






	public.prototype.close = function(){
		_self.inputToastClose();
		_self.close();
	}



	/**
	 * 编辑框错误提示
	 * @param  {[type]} value    提示内容
	 * @param  {[type]} $this    要对处理的文本框或元素标签
	 * @param  {[type]} position 0:底部显示   1：顶部显示
	 * @param  {[type]} offset   偏移量
	 */
	public.prototype.inputToastSuccess = function(value , $this , position , offset){
		clearTimeout(clearTime);
		if(position == undefined || typeof position == 'object'){
			offset = position;
			position = 0;
		}
		if(offset == undefined) offset = {top : -5 , left : 0}
		$thisToast = _self._check('popup_input_toast_success' , '#js-input-toast');
		$thisToast.find('p').html("<i class='fa fa-check'></i>" + value);
		var top = left = 0;
		switch(position){
			case 0:
				top = $this.offset().top + $this.innerHeight() + offset.top + 15;
				left = $this.offset().left + offset.left;
				$thisToast.find('#js-i').attr('class' , 'fa fa-sort-asc').css({
					top : '-17px' , 
					bottom : 'auto'
				}).show()
			break;
			case 1:
				top = $this.offset().top - $this.innerHeight() - offset.top - 15;
				left = $this.offset().left + offset.left;
				$thisToast.find('#js-i').attr('class' , 'fa fa-sort-desc').css({
					bottom : -32 , 
					top : 'auto'
				}).show()
			break;
		}
		$thisToast.animate({
			top : top ,
			left : left
		} , 200).show(100);
		clearTime = setTimeout(function(){
			$thisToast.hide(200)
		} , 2900)
	}
	/**
	 * 编辑框错误提示
	 * @param  {[type]} value    提示内容
	 * @param  {[type]} $this    要对处理的文本框或元素标签
	 * @param  {[type]} position 0:底部显示   1：顶部显示
	 * @param  {[type]} offset   偏移量
	 */
	public.prototype.inputToast = function(value , $this , position , offset){
		clearTimeout(clearTime);
		if(position == undefined || typeof position == 'object'){
			offset = position;
			position = 0;
		}
		if(offset == undefined) offset = {top : -5 , left : 0}
		$thisToast = _self._check('popup_input_toast' , '#js-input-toast');
		$thisToast.find('p').html("<i class='fa fa-remove'></i>" + value);
		var top = left = 0;
		switch(position){
			case 0:
				top = $this.offset().top + $this.innerHeight() + offset.top + 15;
				left = $this.offset().left + offset.left;
				$thisToast.find('#js-i').attr('class' , 'fa fa-sort-asc').css({
					top : '-17px' , 
					bottom : 'auto'
				}).show()
			break;
			case 1:
				top = $this.offset().top - $this.innerHeight() - offset.top - 15;
				left = $this.offset().left + offset.left;
				$thisToast.find('#js-i').attr('class' , 'fa fa-sort-desc').css({
					bottom : -32 , 
					top : 'auto'
				}).show()
			break;
		}
		$thisToast.animate({
			top : top ,
			left : left
		} , 200).show(100);
		clearTime = setTimeout(function(){
			$thisToast.hide(200)
		} , 2900)
	}
	_self.inputToastClose = function(){
		$thisToast = _self._check('popup_input_toast' , '#js-input-toast');
		$thisToast.hide()
	}



	$parent = _self._init();
	return public;
})(jQuery);
