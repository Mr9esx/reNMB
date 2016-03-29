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
		$cookie = htmlspecialchars($_COOKIE["renmbCookies"]);
		$senddate = date("Y-m-d H:i:s",time());
		$uploaderrorcode = $picmsg = "";

		$database = connMySQL();

		$flag = true;

		if($_GET["type"] == "send"){

			if(isblock($_POST["send"])){
				$block = $_POST["send"];
			}else{
				$msg = "未知错误，请联系管理员！";
				$flag = false;
			}

			if(isset($_POST['text']) && $flag){

				if(mb_strlen($_POST['text'],'UTF-8') < 7){
					$msg = "字数不能少于7！";
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
					"page_title" => $title,
					"page_send_time" => $senddate,
					"page_change_time" => $senddate,
					"page_send_cookie" => $cookie,
					"page_name" => $name,
					"page_text" => htmlspecialchars($_POST['text']),
					"img_url" => $picurl,
					"block" => $block
				]);	
				$msg = "文本发送成功！";	
				$errorcode = "0";
			}
			
			$arr = array("errorcode"=>$errorcode,"msg"=>$msg,"uploaderrorcode"=>$uploaderrorcode,"uploadmsg"=>$picmsg);
	        $jarr=json_encode($arr); 
			echo $jarr;

		}



		else if($_GET["type"] == "reply"){

			$id = $_POST['reply'];

			if(isset($_POST['text']) && $flag){

				if(mb_strlen($_POST['text'],'UTF-8') < 7){
					$msg = "字数不能少于7！";
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
					"reply_title" => $title,
					"reply_send_time" => $senddate,
					"reply_send_cookie" => $cookie,
					"reply_name" => $name,
					"reply_text" => $text,
					"img_url" => $picurl,
					"reply_for" => $id,
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