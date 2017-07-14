var ApiRequest = new ApiRequest({


} , {
	url : './api/admin/',
	event : true
});

var popup = new popupWidget();
var dom = new Dom();


$("#js-live-create").click(function(){
	popup.sure({
		title : '创建直播',
		content : dom.get('live-create')
	}).then(function(){
		ApiRequest.push('Live/Create')
	})
})