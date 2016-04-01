<?php 
//服务器状况单独做一个页面
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'server_status') {
			require_once ('func.php');
		}
	}
	require_once ('../config.php');
?>
<!DOCTYPE html>
	<head>
	<?php
		echo "
			<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<link rel=\"stylesheet\" href=\"".WEBROOTURL."/admin/css/style.css\">
			<link rel=\"stylesheet\" href=\"".WEBROOTURL."/css/bootstrap.min.css\">

			<script type=\"text/jscript\" src=\"".WEBROOTURL."/js/jquery.min.js\"></script>
			<script type=\"text/jscript\" src=\"".WEBROOTURL."/js/bootstrap.min.js\"></script>
			<script type=\"text/jscript\" src=\"".WEBROOTURL."/admin/js/highcharts.js\"></script>
			<script type=\"text/jscript\" src=\"".WEBROOTURL."/admin/js/func.js\"></script>
			<script type=\"text/javascript\" src=\"".WEBROOTURL."/js/jquery.form.min.js\"></script>
			";
	?>
	</head>
	<body>
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button> <a class="navbar-brand" href="">匿名版后台</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li id="page_manage">
									 <a href="?action=page_manage">帖子管理</a>
								</li>
								<li id="server_status">
									 <a href="?action=server_status">服务器状况</a>
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
										<li class="divider">
										</li>
										<li>
											 <a href="#">One more separated link</a>
										</li>
									</ul>
								</li> 
							</ul>
						 	<ul class="nav navbar-nav navbar-right">
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
						</ul>
						</div>
					</nav>
					<?php
						if(isset($_GET['action'])){
							$action = $_GET['action'];
							echo "<script type='text/javascript'>document.getElementById('".$action."').className=\"active\";</script>";
							switch ($action) {
								case 'server_status':
									require_once ('./server_status.php');
									break;
								case 'page_manage':
									require_once ('./page_manage.php');
									break;
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
