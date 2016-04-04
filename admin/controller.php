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
			        "is_sega" => 1  
			    ], [
					"id" => $_POST['id']
			    ]);  
				break;
			case 'nobo':
				$database = connMySQL();
				$database->update("nmb_page", [  
			        "is_sega" => 0    
			    ], [
					"id" => $_POST['id']
			    ]);  
				break;
			case 'createblock':
				$flag = true;
				$database = connMySQL();
				if(isset($_POST['father'])){
					if(mb_strlen($_POST['father'],'UTF-8') < 1){
						$errorcode = "1";
						$flag = false;
					}
				}
				if(isset($_POST['son'])){
					if(mb_strlen($_POST['son'],'UTF-8') < 1){
						$errorcode = "1";
						$flag = false;
					}
					$tmp = $database->has("nmb_menu", [
				        "menu_son_menu_name" => addslashes($_POST['son']) 
				    ]);
					if($tmp){
						$errorcode = "2";
						$flag = false;
					}
				}
				if($flag){
					$logo = "fa fa-mars";
					$tmp = $database->has("nmb_menu", [
				        "menu_father_menu_name" => addslashes($_POST['father']) 
				    ]);
					if($tmp){
						$father = $_POST['father'];
						$logo = $database->select("nmb_menu", "menu_father_menu_logo",["menu_father_menu_name" => $father])[0];
					}else{
						$father = $_POST['father'];
					}
					$database->insert("nmb_menu",[
						"menu_father_menu_name" => addslashes($father),
						"menu_son_menu_name" => addslashes($_POST['son']),
						"menu_father_menu_logo" => addslashes($logo)
					]);
					$errorcode = "0";
				}
				$arr = array("errorcode"=>$errorcode);
		        $jarr=json_encode($arr); 
				echo $jarr;
				break;
			case 'changefatherblocklogo':
					$database = connMySQL();
					$logo = addslashes($_POST['logo']);
					$father = addslashes($_POST['father']);
					$tmp = $database->has("nmb_menu", [
				        "menu_father_menu_name" => addslashes($_POST['father']) 
				    ]);
					if($tmp){
						$database->update("nmb_menu", [  
					        "menu_father_menu_logo" => $logo   
					    ], [
							"menu_father_menu_name" => $father
					    ]);  
					    $errorcode = "0";
					}else{
						$errorcode = "1";
					}
					$arr = array("errorcode"=>$errorcode);
			        $jarr=json_encode($arr); 
					echo $jarr;
				break;
			case 'delectblock':
				$database = connMySQL();
				$database->delete("nmb_menu",[
				    "AND" => [
				        "menu_son_menu_name" => $_POST['block']
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