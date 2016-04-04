<?php
require_once ('./Module/func.php');
define('IN_SYS', TRUE);
if(file_exists("./config.php")){
	//检测是否已安装。（简单检测）
	require_once ('./config.php');
	if(ISINSTASLL == '0' || ISINSTASLL == 0){
		//如果已存在config.php文件，ISINSTASLL常量是否为0.
		Header("Location: ./install/index.php");
	}
}else{
	Header("Location: ./install/index.php");
}
?>
<!--头部文件导入-->
<?php getHeader();?>
<!--头部文件导入-->
	<body>
	<!--菜单-->
	<?php

		if((isset($_GET['b']) && !isblock($_GET['b'])) || (isset($_GET['r']) && !ispage($_GET['r']))){
			header('HTTP/1.1 404 Not Found'); 
			header('location: /404.html');	
		}else if(!isset($_GET['b']) && !isset($_GET['r'])){
			getMenu();
			getWelcome();
		}else if(isset($_GET['b']) && isblock($_GET['b'])){
			getMenu();
			getNav();
			getEditor();
			getLoopPage();
		}else{
			header('HTTP/1.1 404 Not Found'); 
			header('location: /404.html');	
		}
	?><div align="center" id="footer" class="container">
			<div class="col-md-12 column" style="margin-top:60px;margin-bottom:30px;">
				<div style="text-align:center;font-size:0.9em;color:#777;">
					Copyright © 2016 · All Rights Reserved · Mr9esx from NERVGEEK
				</div>
				<div style="text-align:center;font-size:0.9em;color:#777;">
				欢迎，这里是匿名版，以宅文化为主题的贴图论坛，在这里不需要注册即可发言。</br>平等的身份，中立的环境，让你尽情讨论你所感兴趣的话题。 
				</div>
			</div>
		</div>
		</div> 
	</body>
</html>
