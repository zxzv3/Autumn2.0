	<link rel="stylesheet" type="text/css" href="./assets/css/home/page/home.css">
</head>
<body>
	<?php $this->load->view(HOME_TEMPLATE . '/template/top-header')?>
	<?php $this->load->view(HOME_TEMPLATE . '/template/menu')?>
	<div class="warpper">
		<div class="tools">
			<button class="btn fezocms"><i class="fa fa-plus"></i>添加银行卡</button>
		</div>
			
			<table class="table-list setting">
				<tr>
					<th width="30"><div class="widget-checkbox"></div></th>
					<th>提现银行卡号</th>
					<th>所属开户行</th>
					<th>提现人</th>
					<th>操作</th>
				</tr>
				

				{Card_list}
				<tr data-data='{data}'>
					<td><div class="widget-checkbox"></div></td>
					<td>{notice}</td>
					<td>{notice}</td>
					<td>{notice}</td>
					<td>
						<i class="fa fa-trash-o"></i>
					</td>
				</tr>
				{/Card_list}

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