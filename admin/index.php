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
			<link rel=\"stylesheet\" href=\"".WEBROOTURL."/css/font-awesome.min.css\">

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
				<div class="col-md-12 column" style="margin-top:60px">
					<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
						<div class="navbar-header">
							 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button> <a class="navbar-brand" href="">匿名版后台</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li id="website_config">
									 <a href="?action=website_config">匿名版设置</a>
								</li>
								<li id="block_manage">
									 <a href="?action=block_manage">版块管理</a>
								</li>
								<li id="page_manage">
									 <a href="?action=page_manage">帖子管理</a>
								</li>
								<li id="reply_manage">
									 <a href="?action=reply_manage">回复管理</a>
								</li>
								<li id="server_status">
									 <a href="?action=server_status">服务器状况</a>
								</li>
								<li id="big_data">
									 <a href="?action=big_data">大数据</a>
								</li>
								<li id="trash">
									 <a href="?action=trash">回收站</a>
								</li>
								<li id="admin">
									 <a href="?action=admin">管理员</a>
								</li>
							</ul>
						 	<ul class="nav navbar-nav navbar-right">
							<li>
								 <a href="#">Admin</a>
							</li>
							<li>
								 <a href="http://127.0.0.1/reNMB">返回主页</a>
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
								case 'block_manage':
									require_once ('./block_manage.php');
									break;
								case 'page_manage':
									require_once ('./page_manage.php');
									break;
								case 'reply_manage':
									require_once ('./reply_manage.php');
									break;
							}
						}

					?>
				</div>
				
			</div>
		</div>

	<div id="footer" class="container">
		<div class="col-md-12 column" style="margin-top:60px;margin-bottom:30px;">
			<div style="text-align:center;font-size:0.9em;color:#777;">
				Copyright © 2016 · All Rights Reserved · Mr9esx from NERVGEEK
			</div>
		</div>
	</div>
	</body>
</html>
