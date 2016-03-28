<?php
function getWebUrl(){
	$PHP_SELF=$_SERVER['PHP_SELF'];
	$url =  'http://'.$_SERVER['HTTP_HOST'].$PHP_SELF;
	for($i = 0;$i <= 1;$i++){
		$tmp = strripos($url,'/');
		$url = substr($url,0,$tmp);
	}
	return $url;
}

function getWebSrc(){
	$src = dirname(dirname(__FILE__));
	return $src;
}



/*function connnet($DATABASESRC,$DATABASEUSER,$DATABASEPASS){
	$host = "mysql:host=".$DATABASESRC.";";
	$user = $DATABASEUSER;
	$pasw = $DATABASEPASS;
	$code = "utf-8";
	$conn = '';
	$conn = new PDO($host,$user,$pasw,array(PDO::ATTR_PERSISTENT => true));
	$conn->query("SET NAMES ".$code.";");
	return $conn;
}*/


	

	

	$flag = false;
	if(isset($_POST['start'])){
		echo $_POST['DATABASESRC'].$_POST['DATABASEUSER'].$_POST['DATABASEPASS'];
		$link=mysql_connect($_POST['DATABASESRC'],$_POST['DATABASEUSER'],$_POST['DATABASEPASS']); 
		//$link = new PDO("mysql:host=".$_POST['DATABASESRC'].";",$_POST['DATABASEUSER'],$_POST['DATABASEPASS']); 
		if($link){
			echo "!";
		}else{
			echo "?";
		}
	    if($link){
	    	echo "!";
	    	$url = getWebUrl();
	    	$src = getWebSrc();
	    	echo "!";
	    	$myfile = fopen("../config.php", "w+");
	    	echo "!";
	    	$txt = "<?php\r\ndefine('DATABASESRC', '".$_POST['DATABASESRC']."');\r\ndefine('DATABASEUSER', '".$_POST['DATABASEUSER']."');
define('DATABASEPASS', '".$_POST['DATABASEPASS']."');\r\ndefine('DATABASECODE', '');\r\ndefine('DATABASENAME', 'renmb');\r\ndefine('COOKIEOPEN', '1');
define('WEBROOTSRC', '".$src."');\r\ndefine('WEBROOTURL', '".$url."');";
			echo "!";
			fwrite($myfile, $txt);
			echo "!";
			fclose($myfile);
			echo "!";
			require_once('../Module/medoo.php');
			require_once('../config.php');
			require_once ('../Module/func.php');
			echo "!";
			$_sql = file_get_contents('renmb.sql');
			echo "!";
			$_arr = explode(';', $_sql);
			echo "!";
			//执行sql语句
			mysql_query("CREATE DATABASE renmb",$link);
			echo "!";
			$conn = connMySQL();
			echo "!";
			foreach ($_arr as $_value) {
				$conn->query($_value);
			}
			$conn->insert("nmb_menu",[
				"menu_father_zh_name" => "综合",
				"menu_son_zh_name" => "综合版"
			]);
			$conn->insert("nmb_config",[
				"COOKIEOPEN" => 1,
				"MINTENANCEMODE" => 0,
				"DEBUGMODE" => 0,
				"ISINSTASLL" => 1,
				"WEBROOTSRC" => '',
				"WEBROOTURL" => $url,
				"WEBROOTSRC" => $src,
				"ID" => "1"
			]);

			$myfile = fopen("../config.php", "a+");
			$txt = "\r\ndefine('ISINSTASLL', '1');\r\n?>";
			fwrite($myfile, $txt);
			fclose($myfile);

			$flag = true;
		}else{
			$flag = false;
		}	
	}
?>
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
					<?php
						if($flag){
							echo "匿名版安装成功";
						}else{
							echo "匿名版安装失败";
						}
					?>
				</h1>
				<div class="colm">
					<h1 class="databasesettitle">
					<?php
						if($flag){
							echo "<a href='".WEBROOTURL."''>开始匿名旅程！</a>";
						}else{
							echo "匿名版安装失败";
						}
					?>
					</h1>
				</div>
					
			</div>
		</div>
	</body>

</html>