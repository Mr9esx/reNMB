<?php 
	//服务器状况单独做一个页面
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'server_status') {
			require_once ('func.php');
		}
	}
	require_once ('../config.php');

	session_start();
	if(isset($_SESSION['flag'])){
		if($_SESSION['flag'] == "true"){
			
		}else{
			Header("Location: login.php");
		}
	}else{
		Header("Location: login.php");
	}
?>
<!DOCTYPE html>
	<head>
	<?php
		echo "
			<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE7' />
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<link rel='stylesheet' href='".WEBROOTURL."/admin/css/style.css'>
			<link rel='stylesheet' href='".WEBROOTURL."/css/bootstrap.min.css'>
			<link rel='stylesheet' href='".WEBROOTURL."/css/font-awesome.min.css'>

			<script type='text/jscript' src='".WEBROOTURL."/js/jquery.min.js'></script>
			<script type='text/jscript' src='".WEBROOTURL."/js/bootstrap.min.js'></script>
			<script type='text/jscript' src='".WEBROOTURL."/admin/js/highcharts.js'></script>
			<script type='text/jscript' src='".WEBROOTURL."/admin/js/func.js'></script>
			<script type='text/javascript' src='".WEBROOTURL."/js/jquery.form.min.js'></script>
			";
	?>
	</head>
	<body>  
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12 column" style="margin-top:60px">
					<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
						<div class="navbar-header">
							 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button> <a class="navbar-brand" href=".">匿名版后台</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
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
								<li id="welcome_config" class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">匿名版设置<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											 <a href="?action=welcome_config">欢迎界面设置</a>
										</li>
										<li>
											 <a href="#">事实告诉我们</a>
										</li>
										<li>
											 <a href="#">不要把各种变量写死</a>
										</li>
										<li>
											 <a href="#">不然要改成可设置</a>
										</li>
										<li class="divider">
										</li>
										<li>
											 <a href="#">忒麻烦了！</a>
										</li>
									</ul>
								</li>
							</ul>
						 	<ul class="nav navbar-nav navbar-right">
							<li>
								 <a href="#"><?php echo $_SESSION['user']?></a>
							</li>
							
							<?php 
							if(isset($_SESSION['user'])){
								echo "<li><a href='javascript:;' id='logout'>登出</a></li>";
							}
							?>
							
							<li style="margin-right:15px">
								 <a href="http://127.0.0.1/reNMB">匿名版</a>
							</li>
						</ul>
						</div>
					</nav>
					<?php
						if(isset($_GET['action'])){
							$action = $_GET['action'];
							echo "<script type='text/javascript'>document.getElementById('".$action."').className='active';</script>";
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
								case 'welcome_config':
									require_once ('./web_config/welcome_config.php');
									break;
							}
						}else{
							require_once ('./welcome.php');
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
