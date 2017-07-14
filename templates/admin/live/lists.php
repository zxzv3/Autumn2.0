	<style>
		body{min-width: 1400px;}
		.top li{
			margin-bottom: 15px;
			margin-right: 4px;
			float: left;
		}
	</style>
</head>
<body>
	
	<?php $this->load->view(ADMINDIR . '/template/menu.php')?>
	<?php $this->load->view(ADMINDIR . '/template/top-header.php')?>
	<div class="warpper">
		<table class="table-list">
			<tr>
				<th><input type="checkbox"></th>
				<th>直播编号</th>	 
				<th>直播标题</th>	 
				<th>录像时间段</th>	 
				<th>存储时长</th>	 
				<th>录像类型</th>	 
				<th>操作</th>	 
			</tr>
			

			{Live_list}
			<tr data-data='{data}'>
				<td style="width: 10px"><input type="checkbox"></td>
				<td style="width: 350px">{id}</td>
				<td style="width: 400px">{video_name}</td>
				<td>{date}</td>
				<td>{store_time} 天</td>
				<td>{record_type}</td>
				<td>
					<i class="fa fa-eye" data-id="{id}"></i>
					<i class="fa fa-edit" data-id="{id}"></i>
					<i class="fa fa-trash-o" data-id="{id}"></i>
				</td>
			</tr>
			{/Live_list}

		</table>
	</div>

	


	<script type="text/dom">
		var live-edit = <div class="live-edit" api-name='Live/Edit'>
			<input type="hidden" api-param-name='id' value="{%id%}" max="32" min="32">
			
			<input type="text" api-param-name='video_name' value="{%video_name%}" name="直播标题" placeholder="请输入直播标题" max="32" min="2">
			<input type="text" api-param-name='record_start' id="inpstart" value="{%record_start%}" max="8" min="8" onclick="jeDate(start)" name="录像开始时间" placeholder="请选择录像开始时间">
			<input type="text" api-param-name='record_end' id="inpend" value="{%record_end%}" max="8" min="8" onclick="jeDate(end)" name="录像结束时间" placeholder="请选择录像结束时间">
			<select api-param-name="store_time" value="{%store_time%}" name="录像时长" placeholder="请选择录像时长" max="2" min="1">
				<option value="0">0天</option>
				<option value="1">1天</option>
				<option value="2">2天</option>
				<option value="3">3天</option>
				<option value="4">4天</option>
				<option value="5">5天</option>
				<option value="6">6天</option>
				<option value="7">7天</option>
				<option value="12">12天</option>
				<option value="16">16天</option>
				<option value="18">18天</option>
				<option value="22">22天</option>
				<option value="28">28天</option>
				<option value="31">31天</option>
			</select>
			<select api-param-name="record_type" value="{%record_type%}" max="1" min="1" name="录像类型" placeholder="请选择录像类型">
				<option value="0">不录像</option>
				<option value="1">定时录像</option>
			</select>
		</div>
	</script>



	<?php $this->load->view(ADMINDIR . '/template/footer.php')?>
	<link rel="stylesheet" type="text/css" href="./assets/bin/jedate/skin/jedate.css">
	<script src="./assets/bin/jedate/jedate.js"></script>
	<script type="text/javascript">
		var start = {
			dateCell: '#inpstart',
			format: 'hh:mm:ss',
			isTime: true,
		};
		var end = {
			dateCell: '#inpend',
			format: 'hh:mm:ss',
			isTime: true,
		};

		


		$(".fa-trash-o").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '删除直播',
				content : "您确定要删除当前的直播数据吗，确认后与该直播相关的所有的录像文件也将会同时间被删除。"
			}).then(function(){
				ApiRequest.push('Live/Remove' , {params : {id : data.id}})
			})
		});
		$(".fa-edit").click(function(){
			var data = $.parseJSON($(this).parent().parent().attr('data-data'));
			popup.sure({
				title : '修改直播',
				content : dom.get('live-edit' , data)
			}).then(function(){
				ApiRequest.push('Live/Edit')
			})
		});



		function ApiRequestSuccess(name , data){
			popup.toast('恭喜您，操作成功，稍后页面将自动刷新');
			ApiRequest.success();
		}
		function ApiRequestError(data , error){
			console.log(error)
			popup.toast(error.message)
		}

		ApiRequest.set({
			success : ApiRequestSuccess,
			error : ApiRequestError,
		})
	</script>
</body>
</html>