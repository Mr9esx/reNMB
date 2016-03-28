<?php
	require_once ('medoo.php');

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
	function getHeader(){
		require_once ('./View/header.php');
	}
	function getMenu(){
		require_once ('./View/menu.php');
	}
	function getEditor(){
		require_once ('./View/editor.php');
	}
	function getLoopPage(){
		require_once ('./View/loop.php');
	}
	function getWebName(){
		return "匿名版";
	}




/*********************************饼干*********************************/

	//判断是否存在饼干
	function isCookies(){
		if(isset($_COOKIE["renmbCookies"])){
			return $_COOKIE["renmbCookies"];
		}
		else{
			create(9);
		}
	}

	//生成饼干
	function create($length){
		$str = null;
		$strPool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPool)-1;

		for($i=0;$i<$length;$i++){
			$str.=$strPool[rand(0,$max)];
		}

		setcookie("renmbCookies",$str,7*24*3600+time());
	}

	//检查当前饼干是否存在
	function cookieisset($cookie){
		$database = connMySQL();
		$tmp = $database->select("nmb_user", ["cookie" => $cookie]);
		return $tmp;
	}

	//获取当前饼干状态
	function getcookiestate($cookie){
		$database = connMySQL();
		$tmp = $database->has("nmb_user", "warning", ["cookie" => $cookie]);
		return $tmp;
	}

	//储存饼干
	function savecookies($cookie){
		$database = connMySQL();
		$senddate = date("Y-m-d H:i:s",time());
		$tmp = $database->insert("nmb_user",["cookie" => $cookie,"create_time" => $senddate,"warning" => "0"]);
	}

/*********************************饼干*********************************/





/*********************************面包导航*********************************/

	//获取面包导航各层次目录
	function getNav(){
	if (isset($_GET['b'])) {
		$p = 1;
		$count = getBlockPageCount($_GET['b']);
		if(isset($_GET['p'])){
			if($_GET['p'] > 0 && $_GET['p'] < $count){
				if($_GET['p'] != 1){
					$p = $_GET['p'];
				}else{
					$p = 1;
				}
			}else if($_GET['p'] >= $count){
				$p = $count;
			}else{
				$p = 1;
			}
		}
		echo "<div id=\"main\"><div id=\"breadcrumbBox\"><ol class=\"breadcrumb\"><li><a href=\"index.php\"><i class=\"fa fa-home\"></i> 主页</a></li>";
		if(isset($_GET['b']) && !isset($_GET['r'])){
			echo "<li class=\"active\">".$_GET['b']."</li>";
		}else if(isset($_GET['b']) && isset($_GET['r'])){
			echo "<li><a href=\"?b=".$_GET['b']."\">".$_GET['b']."</a></li>";
			echo "<li class=\"active\">No.".htmlspecialchars($_GET['r'])."</li>";
		}
		echo "<li class=\"active\">第 ".$p." 页</li>";
		echo "</ol></div>";
		}else{
			exit();
		}
	}

/*********************************面包导航*********************************/

/*对
get r 、 get p进行验证
http://127.0.0.1/reNMB/?b=%E7%BB%BC%E5%90%88%E7%89%88&r=%3Cdiv%20style=%22border:1px%20solid%20red;%22%3E123%3C/div%3E
提交会成功。
解决方法一：每次打开页面都验证r所提交的值是否存在
方法二：可以进去http://127.0.0.1/reNMB/?b=%E7%BB%BC%E5%90%88%E7%89%88&r=%3Cdiv%20style=%22border:1px%20solid%20red;%22%3E123%3C/div%3E页面
但提交时进行验证r是否存在。


p也需要进行验证


伪静态实现


统计打开页面需要进行多少次数据库读写


优化数据库读写，优化程序结构。
*/



/*********************************分页*********************************/

	//帖子分页
	function getpagination($block,$p){
		$count = getBlockPageCount($_GET['b']);
		echo "<ul class=\"pagination\">";
		echo "<li><a href=\"?b=".$block."&p=1\">首页</a></li>";

		$tmp = $p;
		$after = $p+4;
		$tmp1 = $count-$p;
		if($p > 3){
			$before = $p-3;
		}else if($p <= 3){
			$before = 1;
		}
		if($tmp1 <= 3){
			$after = $count;
		}
		

		if($p > $count){
			echo "</ul>";
			return false;
		}
		if($p > 1){
			echo "<li><a href=\"?b=".$block."&p=".($p - 1)."\">上一页</a></li>";
		}
		for($before;$before < $p;$before++){
			echo "<li><a href=\"?b=".$block."&p=".$before."\">".$before."</a></li>";
		}
		echo "<li class=\"active\"><a href=\"?b=".$block."&p=".$p."\">".$p."</a></li>";

		if($tmp != $count){
			for($tmp;$tmp < $after;$tmp){
				echo "<li><a href=\"?b=".$block."&p=".++$tmp."\">".$tmp."</a></li>";
			}
		}

		if($p != $count){
			echo "<li><a href=\"?b=".$block."&p=".($p + 1)."\">下一页</a></li>";
		}		
		echo "</ul>";
	}

	//回复分页
	function getrepination($block,$reply_for,$p){
		$count = getPageReplyCount($reply_for);
		echo "<ul class=\"pagination\">";
		echo "<li><a href=\"?b=".$block."&r=".$reply_for."&p=1\">首页</a></li>";

		$tmp = $p;
		$after = $p+4;
		$tmp1 = $count-$p;
		if($p > 3){
			$before = $p-3;
		}else if($p <= 3){
			$before = 1;
		}
		if($tmp1 <= 3){
			$after = $count;
		}
		

		if($p > $count){
			echo "</ul>";
			return false;
		}
		if($p > 1){
			echo "<li><a href=\"?b=".$block."&r=".$reply_for."&p=".($p - 1)."\">上一页</a></li>";
		}
		for($before;$before < $p;$before++){
			echo "<li><a href=\"?b=".$block."&r=".$reply_for."&p=".$before."\">".$before."</a></li>";
		}
		echo "<li class=\"active\"><a href=\"?b=".$block."&r=".$reply_for."&p=".$p."\">".$p."</a></li>";

		if($tmp != $count){
			for($tmp;$tmp < $after;$tmp){
				echo "<li><a href=\"?b=".$block."&r=".$reply_for."&p=".++$tmp."\">".$tmp."</a></li>";
			}
		}

		if($p != $count){
			echo "<li><a href=\"?b=".$block."&r=".$reply_for."&p=".($p + 1)."\">下一页</a></li>";
		}		
		echo "</ul>";
	}

/*********************************分页*********************************/





/*********************************菜单*********************************/

	//父类菜单
	function drawFatherMenu(){
		$database = connMySQL();
		$MenuFatherBlock = array_unique($database->select("nmb_menu", "menu_father_zh_name"));
		return $MenuFatherBlock;
	}

	//子类菜单
	function drawSonMenu($FatherBlock){
		$database = connMySQL();
		$MenuSonBlock = $database->select("nmb_menu", "menu_son_zh_name",array(  
	        "menu_father_zh_name" => $FatherBlock  
	    ));
		return $MenuSonBlock;
	}

/*********************************菜单*********************************/





/*********************************帖子*********************************/

	//获取板块页数
	function getBlockPageCount($block){
		$loop = 0;
		$pagecount = getPageCount($block);
		if($pagecount%10 != 0){
			$loop = 1;
			$pagecount = $pagecount - ($pagecount%10);
		}
		$loop = $loop + ($pagecount/10);
		return $loop;
	}

	//获取回复页数
	function getPageReplyCount($id){
		$loop = 0;
		$pagecount = getReplyCount($id);
		if($pagecount%10 != 0){
			$loop = 1;
			$pagecount = $pagecount - ($pagecount%10);
		}
		$loop = $loop + ($pagecount/10);
		return $loop;
	}

	//获取帖子数
	function getPageCount($block){
		$database = connMySQL();
		return count($database->select("nmb_page", ["id"],["block" => $block]));
	}

	//获取回复数
	function getReplyCount($id){
		$database = connMySQL();
		return (count($database->select("nmb_reply", ["id"],["reply_for" => $id]))+1);
	}

	//循环输出帖子
	function loopPage($block,$p){
		$database = connMySQL();
		if($p == 1){
			$start = 0;
		}else{
			$start = $p*10-10;
		}
		$tmp = $database->select("nmb_page", [
			"id",
		    "page_title",
		    "page_name",
		    "page_send_time",
		    "page_send_cookie",
		    "img_url",
		    "page_text",
		    "block"
		], [
		    "LIMIT" => [$start,10],
		    "ORDER" => "page_change_time DESC",
		    "block" => $block
		]);
		return $tmp;
	}

	//板块页循环输出回复
	function getNewFiveReply($id){
		$database = connMySQL();
		$tmp = $database->select("nmb_reply", [
		    "reply_title",
		    "reply_name",
		    "reply_send_time",
		    "reply_send_cookie",
		    "img_url",
		    "reply_text",
		    "floor"
		], [
			"LIMIT" => "5",
			"ORDER" => "reply_send_time DESC",
		    "reply_for" => $id
		]);
		return $tmp;
	}

	//循环输出回复
	function getReply($id,$p){
		$database = connMySQL();
		if($p == 1){
			$start = 0;
		}else{
			$start = $p*10-10;
		}
		$tmp = $database->select("nmb_reply", [
		    "reply_title",
		    "reply_name",
		    "reply_send_time",
		    "reply_send_cookie",
		    "img_url",
		    "reply_text",
		    "floor"
		], [
			"LIMIT" => [$start,10],
			"ORDER" => "reply_send_time ACS",
		    "reply_for" => $id
		]);
		return $tmp;
	}

/*********************************帖子*********************************/





/*********************************发布*********************************/

	function getPage($id){
		$database = connMySQL();
		$tmp = $database->select("nmb_page", [
			"id",
		    "page_title",
		    "page_name",
		    "page_send_time",
		    "page_send_cookie",
		    "img_url",
		    "page_text",
		    "block"
		], [
			"id" => $id
		]);
		return $tmp;
	}

	//获取文件类型后缀 
	function extend($file_name){ 
	    $extend = pathinfo($file_name); 
	    $extend = strtolower($extend["extension"]); 
	    return $extend; 
	} 

/*********************************发布*********************************/





/*********************************其余功能*********************************/

	//检查板块是否存在
	function isblock($block){
		$database = connMySQL();
		$tmp = $database->has("nmb_menu", array(  
	        "menu_son_zh_name" => $block  
	    ));
	   	if($tmp){
	   		return true;
	   	}else{
	   		return false;
	   	}
	}

	//返回Json字符串
	function responseJsonString($data){
    	echo json_encode($data,JSON_UNESCAPED_UNICODE);
   		exit;
	}

	//返回Json数组
	function responseJsonArry($data){
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
   		exit;
	}

	function i_array_column($input, $columnKey, $indexKey=null){
	    if(!function_exists('array_column')){ 
	        $columnKeyIsNumber  = (is_numeric($columnKey))?true:false; 
	        $indexKeyIsNull            = (is_null($indexKey))?true :false; 
	        $indexKeyIsNumber     = (is_numeric($indexKey))?true:false; 
	        $result                         = array(); 
	        foreach((array)$input as $key=>$row){ 
	            if($columnKeyIsNumber){ 
	                $tmp= array_slice($row, $columnKey, 1); 
	                $tmp= (is_array($tmp) && !empty($tmp))?current($tmp):null; 
	            }else{ 
	                $tmp= isset($row[$columnKey])?$row[$columnKey]:null; 
	            } 
	            if(!$indexKeyIsNull){ 
	                if($indexKeyIsNumber){ 
	                  $key = array_slice($row, $indexKey, 1); 
	                  $key = (is_array($key) && !empty($key))?current($key):null; 
	                  $key = is_null($key)?0:$key; 
	                }else{ 
	                  $key = isset($row[$indexKey])?$row[$indexKey]:0; 
	                } 
	            } 
	            $result[$key] = $tmp; 
	        } 
	        return $result; 
	    }else{
	        return array_column($input, $columnKey, $indexKey);
	    }
	}
/*********************************其余功能*********************************/
?>