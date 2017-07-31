	<style>
		.edui-container{width: 100%}
	</style>
</head>
<body>
	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<table class="table-list">
			<tr>
				<th width="30"><div class="widget-checkbox"></div></th>
				<th>商户ID</th>	 
				<th>平台编号</th>	 
				<th>商户编号</th>
				<th>支付通道</th>	 
				<th>费率</th>	 
				<th>订单金额</th>	 
				<th>入账金额</th>	 
				<th>创建时间</th>	 
				<th>到帐时间</th>	 
				<!-- <th>异步地址</th>	  -->
				<!-- <th>同步地址</th>	  -->
				<th>通知次数</th>	 
				<th width="110">状态</th>	 
				<th width="100">状态</th>	 
				<th width="110">通知</th>	 
			</tr>
			

			{Order_list}
			<tr data-data='{data}'>
				<td><div class="widget-checkbox"></div></td>
				<td>{from_user}</td>
				<td>{platform_order_id}</td>
				<td>{merchant_order_id}</td>
				<td><span class="label blue-o">{paytype}</span></td>
				<td>{rate}%</td>
				<td>￥{money}</td>
				<td><span class="label {recorded_label}">￥{recorded}</span></td>
				<td>{create_time}</td>
				<td>{arrive_time}</td>
				<!-- <td>{notice_url}</td> -->
				<!-- <td>{active_url}</td> -->
				<td>{notice_count}次</td>
				<td>{type}</td>
				<td>{notice}</td>
				<td>
					<i class="fa fa-check" data-id="{id}"></i>
					<i class="fa fa-trash-o" data-id="{id}"></i>
				</td>
			</tr>
			{/Order_list}

		</table>
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
	
	</div>

	

	<?php $this->load->view(ADMINDIR . '/template/footer.php')?>


	<!-- load umeditor -->
    <link href="./assets/bin/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script src="./assets/bin/umeditor/third-party/jquery.min.js"></script>
    <script src="./assets/bin/umeditor/third-party/template.min.js"></script>
    <script src="./assets/bin/umeditor/umeditor.config.js"></script>
    <script src="./assets/bin/umeditor/umeditor.min.js"></script>
    <script src="./assets/bin/umeditor/lang/zh-cn/zh-cn.js"></script>
	<!-- load umeditor -->

	<script type="text/javascript">
		$(".fa-edit").click(function(){
			window.location.href='./<?=ADMINDIR?>/article/edit?id=' + $(this).data('id')
		});

		$(".fa-check").click(function(event) {
			var id = $(this).data('id');
			popup.sure({
				title : '确认通知',
				content : '您确定要通知这个订单吗？您确定要通知这个订单吗？您确定要通知这个订单吗？您确定要通知这个订单吗？',
			}).then(function(){
				ApiRequest.push('Order/Check' , {params : {id : id}})
			})
		});

		$(".fa-trash-o").click(function(event) {
			var id = $(this).data('id');
			popup.sure({
				title : '确认删除',
				content : '您确定要删除这个订单吗？您确定要删除这个订单吗？您确定要删除这个订单吗？您确定要删除这个订单吗？',
			}).then(function(){
				ApiRequest.push('Order/Remove' , {params : {id : id}})
			})
		});


	</script>

</body>
</html>