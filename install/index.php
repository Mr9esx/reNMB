<html>
	<head>
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
		
		<script type="text/jscript" src="../js/jquery.min.js"></script>
		<script type="text/jscript" src="../js/bootstrap.min.js"></script>

		<link href="favicon.ico" mce_href="favicon.ico" rel="icon" type="image/x-icon" /> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
		</title>
		<script>
/*			$(document).ready(function () {
				alert("!");
			});*/
		</script>
		<style>
			.text-center{
				margin-top: 5%;
				font-size: 3.5em;
			}
			.colm {
			  width: auto;
			  display: table;
			  margin-left: auto;
			  margin-right: auto;
			}
			.databasesettitle{
				padding: 10px 0 16px 0;
				text-align: center;
				font-size: 1.5em;
			}
			#databaseset{
				float: right;
				margin-right: -15px !important;
			}
			body{
				background-color: #f9f9f9;
			}
			#start{
				margin: 0 auto;
				text-align: center;
				margin-top: 10%; 
			}
			#start button{
				padding: 10px 40px 10px 40px;
			}
		</style>
	</head>
	<body>


		<div class="container">
   			<div class="row" >
   				<h1 class="text-center">
					匿名版安装
				</h1>

				<div class="colm">
					<h1 class="databasesettitle">
						数据库设置
					</h1>
					<form class="form-horizontal" role="form" method="POST" action="install.php">
						<div class="form-group">
							<div class="input-group">
						        <span class="input-group-addon">数据库地址</span>
						        <input type="text" class="form-control" name="DATABASESRC" value="localhost">
					   		</div>
						</div>

						<div class="form-group">
							<div class="input-group">
						        <span class="input-group-addon">数据库账号</span>
						        <input type="text" class="form-control" name="DATABASEUSER" value="root">
					   		</div>
						</div>
						<div class="form-group">
							<div class="input-group">
						        <span class="input-group-addon">数据库密码</span>
						        <input type="text" class="form-control" name="DATABASEPASS">
					   		</div>
						</div>
						<div id="start">
							 	<button class="btn btn-info btn-lg " type="submit" name="start">安装</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</body>

</html>