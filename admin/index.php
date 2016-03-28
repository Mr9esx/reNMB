<?php 
	require_once ('func.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="./admin/style.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">

		<script type="text/jscript" src="./js/jquery.min.js"></script>
		<script type="text/jscript" src="./js/bootstrap.min.js"></script>
		<script type="text/jscript" src="admin/highcharts.js"></script>
		<script type="text/jscript" src="admin/func.js"></script>
	</head>
	<body>
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button> <a class="navbar-brand" href="#">匿名版后台</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active">
								 <a href="#">服务器状况</a>
							</li>
							<!-- <li class="dropdown">
								 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										 <a href="#">Action</a>
									</li>
									<li>
										 <a href="#">Another action</a>
									</li>
									<li>
										 <a href="#">Something else here</a>
									</li>
									<li class="divider">
									</li>
									<li>
										 <a href="#">Separated link</a>
									</li>
									<li class="divider">
									</li>
									<li>
										 <a href="#">One more separated link</a>
									</li>
								</ul>
							</li> -->
						</ul>
					<!-- 	<ul class="nav navbar-nav navbar-right">
						<li>
							 <a href="#">Link</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									 <a href="#">Action</a>
								</li>
								<li>
									 <a href="#">Another action</a>
								</li>
								<li>
									 <a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									 <a href="#">Separated link</a>
								</li>
							</ul>
						</li>
					</ul> -->
					</div>
				</nav>
				<div class="row clearfix" style="margin-bottom:20px">
					<div class="col-md-6 column">
						<div id="ServerDiskUsedStyle">
							<div class="ServerTitle">服务器硬件信息</div>
							<ul class="list-group">
							   <li class="list-group-item">CPU型号：<br/>
									<?php echo $sysInfo['cpu']['model']?></li>
							   <li class="list-group-item">内存大小：
							   		<?php echo $mt?></li></li>
							   <li class="list-group-item">硬盘大小：
							   		<?php echo $dt;?> GB</li>
							   <li class="list-group-item">24*7 支持</li>
							</ul>

						</div>
					</div>
					<div class="col-md-3 column" >
						<div id="ServerDiskUsedStyle">
							<div class="ServerTitle">服务器参数</div>
						</div>
					</div>
					<div class="col-md-3 column" >
						<div id="ServerDiskUsedStyle">
							<div class="ServerTitle">服务器硬盘使用率</div>
							<div style="height:200px" id="ServerDiskUsed"></div>
						</div>
					</div>
					<div class="col-md-6 column">
						
					</div>
				</div>
				<div class="row clearfix"><div class="col-md-6 column">
						<div style="height:240px" id="ServerCPUUsed"></div>
					</div>
					<div class="col-md-6 column">
						<div style="height:240px" id="ServerMemoryUsed"></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	</body>
</html>
