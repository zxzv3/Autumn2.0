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
	<?php
		$maxDisk = round(disk_total_space('/') / 1024 / 1024 / 1024 , 0);
		$nowDisk = round(disk_free_space('/') / 1024 / 1024 / 1024);
	?>

	<div class="warpper">
		
		<div class="box fl">
			<h1>环境状态</h1>
			<div class="left fl">
				<p>系统版本号：1.5.4</p>
				<p>平台版本号：1.0</p>
				<p>PHP版本：<?=PHP_VERSION?></p>
				<p>Mysql版本：<?=phpversion()?></p>
				<p>Apache版本：<?=substr(apache_get_version() , 0 , 15)?>...</p>
			</div>
		</div>
		
		<div class="box fl">
			<h1>硬件状态</h1>
			<div class="left fl">
				<p>硬盘可用空间：<?=$maxDisk - $nowDisk?>G / <?=$maxDisk?>G</p>
				<p>内存占用率：<?=$maxDisk - $nowDisk?>G / <?=$maxDisk?>G</p>
				<p>CPU占用率：<?=$maxDisk - $nowDisk?>G / <?=$maxDisk?>G</p>
			</div>
		</div>
		
		<div class="box fl">
			<h1>队列状态</h1>
			<div class="left fl">
				<p>正在转码：0个</p>
				<p>正在直播：0个</p>
			</div>
		</div>

		
		<div class="box fl">
			<h1>服务状态</h1>
			<div class="left fl" style="margin-left: 14px;">
				<span class="label success">转码服务</span>
				<span class="label success">直播服务</span>
			</div>
		</div>
	</div>
	<?php
		$max = round(disk_total_space('/') / 1024 / 1024 / 1024 , 0);
	?>
	<?php $this->load->view(ADMINDIR . '/template/footer.php')?>
	<script type="text/javascript">
		var ctx = document.getElementById("myChartDisk");
		var myChart = new Chart(ctx, {
		    type: 'doughnut',
		    data: {
			    labels: [
			        "剩余空间",
			        "已用空间",
			    ],
			    datasets: [{
		            data: [<?=$max?> , <?=$maxDisk - $nowDisk?>],
		            backgroundColor: [
		                "#34bf5e",
		                "#ff0000",
		            ],
		            hoverBackgroundColor: [
		                "#34bf5e",
		                "#ff0000",
		            ]
		        }]
			},
		    options: {
		    	// circumference : 1,
		    	cutoutPercentage :60,
		    	// rotation : 2 * Math.PI,
		    	// circumference : 2 * Math.PI,
		    	maintainAspectRatio : false,
				animation:{
					animateRotate:true,
					animateScale:true
				}
		    }
		});
		

		var myChartLine = document.getElementById("js-myChartLine");
		var myChart = new Chart(myChartLine, {
		    type: 'line',
			data: {
		   		labels: [
		   			"24:00", "1:00", "2:00", "3:00", "4:00", "5:00", "6:00",
		   			"7:00", "8:00", "9:00", "10:00", "11:00", "12:00",
		   			"13:00", "14:00", "15:00", "16:00", "17:00", "18:00",
		   			"19:00", "20:00", "21:00", "22:00", "23:00",
		   		],
			    datasets: [{
			        label: '访问人数',
					fill: false, 
					lineTension: 0.4,  //弧度
					backgroundColor: "rgba(75,192,192,0.4)",
					borderColor: "rgba(75,192,192,1)",
					borderCapStyle: 'butt',
					borderDash: [],
					borderDashOffset: 0.0,
					borderJoinStyle: 'miter',
					pointBorderColor: "rgba(75,192,192,1)",
					pointBackgroundColor: "#fff",
					pointBorderWidth: 1,
					pointHoverRadius: 4,
					pointHoverBackgroundColor: "rgba(75,192,192,1)",
					pointHoverBorderColor: "rgba(220,220,220,1)",
					pointHoverBorderWidth: 2,
					pointRadius: 4,
					pointHitRadius: 10,
					data: [1,1,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
					spanGaps: false,
			        borderColor : '#34bf5e'
			    }]
			},
			options: {
		    	maintainAspectRatio : false,
			    scales: {
			        // xAxes: [{
			        //     type: 'linear',
			        //     position: 'bottom'
			        // }]
			    }
			}
		});		
	</script>
</body>
</html>