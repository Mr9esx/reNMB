<?php
require_once ('./Module/func.php');
if(file_exists("./config.php")){
	require_once ('./config.php');
	if(ISINSTASLL == '0' || ISINSTASLL == 0){
		Header("Location: ./install/index.php");
	}
}else{
	Header("Location: ./install/index.php");
}
?>
<!--饼干检查-->
<?php isCookies()?>
<!--头部文件导入-->
<?php getHeader();?>
<!--头部文件导入-->
	<body>
	<!--菜单-->
	<?php 
		if(isset($_GET['b']) && !isblock($_GET['b'])){
			header('HTTP/1.1 404 Not Found'); 
			header('location: /404.html');	
		}else if(!isset($_GET['b'])){
			getMenu();
			/*getindexPage();*/
		}else if(isset($_GET['b']) && isblock($_GET['b'])){
			getMenu();
			getNav();
			getEditor();
			getLoopPage();
		}
	?>
		</div> 
	</body>
</html>
