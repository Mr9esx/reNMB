<?php
	
?>
<!Doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type='text/jscript' src='../js/jquery.min.js'></script>
	<script type='text/jscript' src='js/login.js'></script>

</head>
<body style="margin:0 auto;background-size:100%;overflow:hidden;" background="http://127.0.0.1/reNMB/upload/background/bg1.jpg">
	<div id="login">
		<h2><span class="fontawesome-lock"></span>匿名版后台登陆</h2>
		<fieldset>
			<p><label for="email">用户名</label></p>
			<p><input type="text" id="user"></p> 
			<p><label for="password">密码</label></p>
			<p><input type="password" id="password"></p> 
			<p><input type="checkbox" id="rme">七天免登录</p> 
			<p><input type="submit" id="loginbtn" value="登陆"></p>
			<div id="msg"></div>
		</fieldset>
	</div>
</body>
</html>