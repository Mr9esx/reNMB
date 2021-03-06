<?php
	require_once ('../config.php');
	require_once ('func.php');

	if(isset($_GET['type'])){
		//初始化
		$title = "";
		$name = "";
		$block = "";
		$picurl = "";
		$picmsg = "";
		$msg = "";
		$text = "";
		$errorcode = "";
		$cookie = "";
		$senddate = date("Y-m-d H:i:s",time());
		$uploaderrorcode = $picmsg = "";

		$database = connMySQL();

		$flag = true;

		if(COOKIEOPEN == 0 && !isset($_COOKIE["renmbCookies"])){
			$msg = "目前饼干停止发放。";
			$errorcode = "1";
			$flag = false;
		}else if(COOKIEOPEN == 1 && !isset($_COOKIE["renmbCookies"])){
			$cookie = createCookies(9);
		}else if(isset($_COOKIE["renmbCookies"])){
			$cookie = getcookies($_COOKIE["renmbCookies"]);
		}

		if($_GET["type"] == "send" && $flag){

			//非法访问或者其他错误
			if(isblock($_POST["send"]) && $flag){
				$block = $_POST["send"];
			}else{
				$msg = "未知错误，请联系管理员！";
				$flag = false;
			}

			//发文时间间距
			if(!checkSendTime($cookie)){
				$msg = "发文间距为15秒！";
				$errorcode = "1";
				$flag = false;
			}

			//字数控制
			if(isset($_POST['text']) && $flag){
				if(mb_strlen($_POST['text'],'UTF-8') < 5){
					$msg = "字数不能少于5！";
					$errorcode = "1";
					$flag = false;
				}else{
					$text = htmlentities($_POST['text']);
				}
			}

			
			if(isset($_POST['title']) && $flag){
				if($_POST['title'] == ""){
					$title = "无标题";
				}else{
					$title = htmlspecialchars($_POST['title']);
				}
			}
			if(isset($_POST['name']) && $flag){
				if($_POST['name'] == ""){
					$name = "无名氏";
				}else{
					$name = htmlspecialchars($_POST['name']);
				}
			}
			if(isset($_FILES['picFile']) && $flag){
				$tmp = savePic();
				if($tmp['errorcode'] == "0"){
					$picmsg = $tmp['msg'];
					$picurl = $tmp['picurl'];
					$uploaderrorcode = $tmp['errorcode'];
				}else if($tmp['errorcode'] != "0"){
					$uploaderrorcode = $tmp['errorcode'];
					$picmsg = $tmp['msg'];
				}
			}
			if($flag){
				$database->insert("nmb_page",[
					"page_title" => addslashes($title),
					"page_send_time" => $senddate,
					"page_change_time" => $senddate,
					"page_send_cookie" => addslashes($cookie),
					"page_name" => addslashes($name),
					"page_text" => htmlspecialchars($_POST['text']),
					"img_url" => $picurl,
					"block" => addslashes($block)
				]);	
				$msg = "文本发送成功！";	
				$errorcode = "0";
			}
			$arr = array("errorcode"=>$errorcode,"msg"=>$msg,"uploaderrorcode"=>$uploaderrorcode,"uploadmsg"=>$picmsg);
	        $jarr=json_encode($arr); 
			echo $jarr;
		}



		else if($_GET["type"] == "reply" && $flag){

			$block = $_POST['send'];
			$id = $_POST['reply'];

			if(!ispage($id)){
				$flag = false;
			}

			if(!checkSendTime($cookie)){
				$msg = "发文间距为15秒！";
				$errorcode = "1";
				$flag = false;
			}

			if(isset($_POST['text']) && $flag){

				if(mb_strlen($_POST['text'],'UTF-8') < 5){
					$msg = "字数不能少于5！";
					$flag = false;
				}else{
					$text = htmlentities($_POST['text']);
				}

			}

			if(isset($_POST['title']) && $flag){

				if($_POST['title'] == ""){
					$title = "无标题";
				}else{
					$title = htmlspecialchars($_POST['title']);
				}

			}

			if(isset($_POST['name']) && $flag){

				if($_POST['name'] == ""){
					$name = "无名氏";
				}else{
					$name = htmlspecialchars($_POST['name']);
				}

			}

			if(!ispage($id)){
				$flag = false;
			}

			if(isset($_FILES['picFile']) && $flag){
				$tmp = savePic();
				if($tmp['errorcode'] == "0"){
					$picmsg = $tmp['msg'];
					$picurl = $tmp['picurl'];
					$uploaderrorcode = $tmp['errorcode'];
				}else if($tmp['errorcode'] != "0"){
					$uploaderrorcode = $tmp['errorcode'];
					$picmsg = $tmp['msg'];
				}
			}

			$floor = getReplyCount($id);

			if($flag){
				$database->insert("nmb_reply",[
					"reply_title" => addslashes($title),
					"reply_send_time" => $senddate,
					"reply_send_cookie" => addslashes($cookie),
					"reply_name" => addslashes($name),
					"reply_text" => addslashes($text),
					"img_url" => $picurl,
					"reply_for" => addslashes($id),
					"block" => addslashes($block),
					"floor" => $floor
				]);
				$msg = "文本发送成功！";	
				$errorcode = "0";
				$msg = "回复成功！";
			}
			$database->update("nmb_page",["page_change_time" => $senddate],["id" => $id]);	
			$arr = array("errorcode"=>$errorcode,"msg"=>$msg,"uploaderrorcode"=>$uploaderrorcode,"uploadmsg"=>$picmsg);
	        $jarr=json_encode($arr); 
			echo $jarr;	
		}
	}
	function savePic(){
		$image_name = NULL;
		$extArr = array("jpg", "png", "gif", "ico"); 
		$realPath = WEBROOTSRC."/upload/images/"; //物理真实地址
		$savePath = WEBROOTURL."/upload/images/"; //网页显示地址
		$arr = NULL;
					 
		if(isset($_POST)){ 
		    $name = $_FILES['picFile']['name']; 
		    $size = $_FILES['picFile']['size']; 
		     
		    $ext = extend($name); 

		    if(!in_array($ext,$extArr)){ 
		    	$arr = array("errorcode"=>'1',"msg"=>"图片格式错误！");
		        return $arr;
		    } 

		    if($size>(3000*1024)){ 
		    	$arr = array("errorcode"=>'2',"msg"=>"图片大小不能超过3MB！");
		        return $arr;
		    } 

		    $image_name = time().rand(100,999).".".$ext; 
		    $tmp = $_FILES['picFile']['tmp_name']; 
		    if(move_uploaded_file($tmp, $realPath.$image_name)){ 
		        $arr = array("errorcode"=>'0',"msg"=>"图片上传成功！","picurl"=>$savePath.$image_name);
		        return $arr;
		    }else{ 
		    	$arr = array("errorcode"=>'3',"msg"=>"上传出错，请联系管理员！");
		     	return $arr;	
		    } 
		} 
	}
?>