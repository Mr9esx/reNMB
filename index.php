<?php
require_once ('./Module/func.php');
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
	?>
		</div> 
	</body>
</html>
