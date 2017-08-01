	<link rel="stylesheet" type="text/css" href="./assets/css/home/page/home.css">
</head>
<body>
	<?php $this->load->view(HOME_TEMPLATE . '/template/top-header')?>
	<?php $this->load->view(HOME_TEMPLATE . '/template/menu')?>
	<div class="warpper">
		<table class="table-list">
			<tr>
				<th width="30"><div class="widget-checkbox"></div></th>
				<th>平台编号</th>	 
				<th>商户编号</th>
				<th>支付通道</th>	 
				<th>手续费</th>	 
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
				</td>
			</tr>
			{/Order_list}

		</table>
		<?php $this->load->view(ADMIN_TEMPLATE . '/template/page.php');?>
	
	</div>

    <?php $this->load->view(HOME_TEMPLATE . '/template/footer');?>
	<script type="text/javascript">

		$(".fa-check").click(function(event) {
			var id = $(this).data('id');
			popup.sure({
				title : '确认通知',
				content : '您确定要通知这个订单吗？您确定要通知这个订单吗？您确定要通知这个订单吗？您确定要通知这个订单吗？',
			}).then(function(){
				ApiRequest.push('Order/Check' , {params : {id : id}})
			})
		});

	</script>
</body>
</html>