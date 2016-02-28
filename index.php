<?php
require_once ('WindowsUptime.class.php');
$windowsUptime = new WindowsUptime();
?>
<html>
	<head>
		<title>Stats</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
		<script type="text/javascript">
			var loadavgs=[];
			
			function dothething() {
				$.get("getcpu.php", function(response) {
					var num = parseFloat(response);
					num = num.toFixed(0);
					myLine.datasets[0].points[0].value = myLine.datasets[0].points[1].value;
					myLine.datasets[0].points[1].value = myLine.datasets[0].points[2].value;
					myLine.datasets[0].points[2].value = myLine.datasets[0].points[3].value;
					myLine.datasets[0].points[3].value = myLine.datasets[0].points[4].value;
					myLine.datasets[0].points[4].value = myLine.datasets[0].points[5].value;
					myLine.datasets[0].points[5].value = myLine.datasets[0].points[6].value;
					myLine.datasets[0].points[6].value = num;
				});
				
				$.get("getcpu.php", function(response) {
					var num = parseFloat(response);
					num = num.toFixed(0);
					myLine.datasets[1].points[0].value = myLine.datasets[1].points[1].value;
					myLine.datasets[1].points[1].value = myLine.datasets[1].points[2].value;
					myLine.datasets[1].points[2].value = myLine.datasets[1].points[3].value;
					myLine.datasets[1].points[3].value = myLine.datasets[1].points[4].value;
					myLine.datasets[1].points[4].value = myLine.datasets[1].points[5].value;
					myLine.datasets[1].points[5].value = myLine.datasets[1].points[6].value;
					myLine.datasets[1].points[6].value = num;
				});
				
				$.get("getnet.php", function(response) {
					response = response + 'MB/s ↓';
					$('.m1').html(response);
				});
				$.get("getnetup.php", function(response) {
					response = response + 'MB/s ↑';
					$('.m3').html(response);
				});
				
				myLine.update();
			}
			
			var refreshId = setInterval(dothething, 5000);
		  
        </script>  
		<style>
			body{
				background: #212121;
				color: #C0C0C0;
				font-family: 'Dosis', sans-serif;
			}
			.top, .middle, .bottom{
				width:100%;
			}
			div{
				border: none;
			}
			.top{
				text-align:center;
			}
			.m1, .m2, .m3{
				text-align:center;
				width:33%;
				display:inline-block;
				padding-top: 50px;
				padding-bottom: 10px;
				line-height:50px;
			}
			.m1{float:left;} .m2{float:center;} .m3{float:right;}
			.b0{
				width: 120px;
				height: 50px;
				line-height:50px;
				margin: 0 auto;
				border: 1px solid #C0C0C0;
				text-align:center;
			}
			.b1, .b2{
				height:20px;width:50px;
				padding:5px;
				display:inline;
				text-align:center;
			}
			.b1{
				/*cpu*/
				background:rgba(97,97,97,0.5);
			}
			.b2{
				/*ram*/
				background:rgba(244,244,244,0.5);
			}
		</style>
	</head>
	<body>
		<div class='container'>
			<div class='top'>
				<?php $time = $windowsUptime->uptime(); echo $time;?>
			</div>
			<div class='middle'>
				<div class='m1'></div>
				<div class='m2'>
					<div class='b0'>
						<div class='b1'>CPU</div>
						<div class='b2'>RAM</div>
					</div>
				</div>
				<div class='m3'></div>
			</div>
			<div class='bottom'>
				<canvas id="canvas" style='height:400px;width:100%;'></canvas>
			</div>
		</div>
		<script>
			var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
			var lineChartData = {
				labels : ["30","25","20","15","10","5","0"],
				datasets : [
					{
						label: "CPU",
						fillColor : "rgba(97,97,97,0.5)",
						strokeColor : "#CFD8DC",
						pointColor : "#757575",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(220,220,220,1)",
						data : [0,0,0,0,0,0,0]
					},
					{
						label: "RAM",
						fillColor : "rgba(244,244,244,0.5)",
						strokeColor : "#78909C",
						pointColor : "#757575",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(151,187,205,1)",
						data : [0,0,0,0,0,0,0]
					}
				]

			}

			window.onload = function(){
				var ctx = document.getElementById("canvas").getContext("2d");
				window.myLine = new Chart(ctx).Line(lineChartData, {
					scaleOverride: true,
					scaleSteps: 10,
					scaleStepWidth: 10,
					scaleStartValue: 0,
					responsive: true
				});
				dothething();
			}

		</script>
	</body>
</html>