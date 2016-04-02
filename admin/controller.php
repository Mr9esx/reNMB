<?php
	if(isset($_GET['action'])){
//使用try catch，以免删除失败
		require_once ('../Module/medoo.php');
		require_once ('../config.php');
		function connMySQL(){
	    	return $database = new medoo(array(
		        'database_type' => 'mysql', //连接类型：mysql、mssql、sybase  
		        'database_name' => DATABASENAME, //数据库名  
		        'charset' => 'utf8',
		        'server' => DATABASESRC, //数据库地址   
		        'username' => DATABASEUSER, //数据库账号  
		        'password' => DATABASEPASS, //数据库密码  
	   		));  
	    }

		switch ($_GET['action']) {
			case 'deletePage':
				$database = connMySQL();
				$database->delete("nmb_page", [
				    "AND" => [
				        "id" => $_POST['id']
				    ]
				]);
				break;
			case 'deleteReply':
				$database = connMySQL();
				$database->delete("nmb_reply", [
				    "AND" => [
				        "id" => $_POST['id']
				    ]
				]);
				break;
			case 'sega':
				$database = connMySQL();
				$database->update("nmb_page", array(  
			        "is_sega" => 1,    
			    ), [
					"id" => $_POST['id']
			    ]);  
				break;
			case 'nobo':
				$database = connMySQL();
				$database->update("nmb_page", array(  
			        "is_sega" => 0,    
			    ), [
					"id" => $_POST['id']
			    ]);  
				break;
			default:
				# code...
				break;
		}
	}
?>