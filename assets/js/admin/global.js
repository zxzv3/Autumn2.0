var ApiRequest = new ApiRequest({


} , {
	url : './api/admin/',
	event : true
});

var popup = new popupWidget();
var dom = new Dom();


$(document).on('click', ".widget-checkbox", function(event) {
	$(this).toggleClass('active');
});


$('select').each(function(key , value){
	var selectValue = $(value).attr('value');
	$(value).find('option[value="' + selectValue + '"]').attr('selected' , true)
});


if(typeof ApiRequestSuccess == 'undefined'){
	function ApiRequestSuccess(name , data){
		popup.toast('恭喜您！操作成功，页面稍后将会自动刷新更新数据');
		ApiRequest.success();
	}
}


if(typeof ApiRequestError == 'undefined'){
	function ApiRequestError(name , error){
		popup.toast(error.message)
		// console.log(error)
		// if(isset(data.data) && data.data.length > 0 && data.data != {}){
		// 	popup.inputToast(data.message , data.data[0].data)
		// }else{
		// }
	}
}


ApiRequest.set({
	success : ApiRequestSuccess,
	error : ApiRequestError,
})


$(document).on('change' , '#js-switch' , function(){
	window.location.href = '?ss'
})