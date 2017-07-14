<div class="top-header">
	<div class="item">
		<i class="fa fa-cog"></i>
		<span>系统设置</span>
	</div>

	<div class="item">
		<i class="fa fa-user-o"></i>
		<span>直播列表</span>
	</div>
	<div class="item" style="cursor: pointer;" id="js-live-create">
		<i class="fa fa-plus"></i>
		<span>创建直播</span>
	</div>

	<div class="item">
		<i class="fa fa-file-text-o"></i>
		<span>创建转码</span>
	</div>

	<div class="item">
		<i class="fa fa-list"></i>
		<span>系统升级</span>
	</div>



	<div class="item" style="float: right;display: none">
		<i class="fa fa-bell-o"></i>
		<span>新消息</span>
		<div class="news"></div>
		<div class="list-message">
			<ul>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
				<li><a href="">您有最新的消息</a><span class="time">4-07</span></li>
			</ul>
		</div>
	</div>
	<div class="item" style="float: right;display: none">
		<i class="fa fa-envelope-o"></i>
		<span>内部邮件</span>
		<div class="news"></div>
	</div>
</div>


<script type="text/dom">
	var live-create = <div class="live-create" api-name='Live/Create'>
		
		<input type="text" api-param-name='video_name' name="直播标题" placeholder="请输入直播标题" max="32" min="2">
		<input type="text" api-param-name='record_start' id="inpstart" max="8" min="8" onclick="jeDate(start)" name="录像开始时间" placeholder="请选择录像开始时间">
		<input type="text" api-param-name='record_end' id="inpend" max="8" min="8" onclick="jeDate(end)" name="录像结束时间" placeholder="请选择录像结束时间">
		<select api-param-name="store_time" name="录像时长" placeholder="请选择录像时长" max="2" min="1">
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
		<select api-param-name="record_type" max="1" min="1" name="录像类型" placeholder="请选择录像类型">
			<option value="0">不录像</option>
			<option value="1">定时录像</option>
		</select>
	</div>
</script>
