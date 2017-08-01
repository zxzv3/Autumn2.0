$("#js-phone").click(function(){
	popup.sure({
		title : '修改',
		content : '<input type="text" placeholder="请输入"/>'
	})
});
$("#js-email").click(function(){
	popup.sure({
		title : '修改',
		content : '<input type="text" placeholder="请输入"/>'
	})
});
$("#js-realName").click(function(){
	popup.sure({
		title : '修改',
		content : '<input type="text" placeholder="请输入"/>'
	})
});
$("#js-password").click(function(){
	popup.sure({
		title : '修改',
		content : '<input type="text" placeholder="请输入"/>'
	})
});

$("#js-withdrawals").click(function(){
	popup.sure({
		title : '申请提现',
		content : dom.get('withdrawals')
	})
})