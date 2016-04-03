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
			case 'delectPage':
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
				$database->update("nmb_page", [  
			        "is_sega" => 1,    
			    ], [
					"id" => $_POST['id']
			    ]);  
				break;
			case 'nobo':
				$database = connMySQL();
				$database->update("nmb_page", [  
			        "is_sega" => 0,    
			    ], [
					"id" => $_POST['id']
			    ]);  
				break;
			case 'createblock':
				$database = connMySQL();
				$database->insert("nmb_menu",[
					"menu_father_zh_name" => $_POST['father'],
					"menu_son_zh_name" => $_POST['son'],
					"menu_father_zh_logo" => $_POST['logo']
				]);
				break;
			case 'delectblock':
				$database = connMySQL();
				$database->delete("nmb_menu",[
				    "AND" => [
				        "menu_son_zh_name" => $_POST['block']
				    ]
				]);
				break;
			case 'replycheckbox':
				if(isset($_POST['Arr']) && $_POST['Arr'] != NULL){
					$database = connMySQL();
					$Arr = $_POST['Arr'];
					foreach ($Arr as $k=>$v) {
					    $database->delete("nmb_reply", [
						    "AND" => [
						        "id" => $v
						    ]
						]);
					}
				}else{
					exit();
				}
				break;
			case 'pagecheckbox':
				if(isset($_POST['Arr']) && $_POST['Arr'] != NULL){
					$database = connMySQL();
					$Arr = $_POST['Arr'];
					foreach ($Arr as $k=>$v) {
					    $database->delete("nmb_page", [
						    "AND" => [
						        "id" => $v
						    ]
						]);
					}
				}else{
					exit();
				}
				break;
			default:
				# code...
				break;
		}
	}
?>