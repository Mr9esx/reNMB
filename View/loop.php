<?php
	if (isset($_GET['b']) && !isset($_GET['r'])) {

		$block = $_GET['b'];

		//处理页数
		if(isset($_GET['p'])){
			$p = checkPage($block,$_GET['p'],0);
		}else{
			$p = checkPage($block,1,0);
		}


		$loopPage = loopPage($_GET['b'],$p);
		foreach($loopPage as $pageData){			

			$pageName = "";
			$pageTitle = "";
			$allReply = "";
			$img = "";
			//获取发帖时间
			$sendTime = $pageData['page_send_time'];
			//获取发帖人的饼干
			$sendCookie = $pageData['page_send_cookie'];
			//获取帖子的id			
			$pageID = $pageData['id'];
			//获取帖子的内容
			$text = $pageData['page_text'];
			//获取帖子的板块
			$block = $pageData['block'];
			//获取帖子的标题和姓名
			$pageTitle = $pageData["page_title"];
			$pageName = $pageData["page_name"];

			//获取page的id，用来获取该id的回复
			$reply = getNewFiveReply($pageID);
			$replyFloor = i_array_column($reply, 'floor');



			//判断是否有回复，当回复数大于5时便隐藏
			if($reply == false){
				$allReply = "<div class=\"howMuchReplyHidden\">-本串尚未有人回复，可点击\"回复\"进入串内回复-</div>";
			}else if($replyFloor[0] > 5){
				$allReply = "<div class=\"howMuchReplyHidden\">-本串有".($replyFloor[0]-5)."篇回复被隐藏，查看更多请点击\"回复\"-</div>";
			}

			//判断是否有图片
			if($pageData['img_url'] != NULL){
				$img = "<img class=\"pageImg\" src=\"".$pageData['img_url']."\">";
			}else{
				$img = NULL;
			}


			//输出
			$text = str_replace("&lt;br/&gt;", "<br/>",$text);
			echo "
			<div id=\"loopPage\">
				<div class=\"panel panel-info\">
					<div class=\"panel-heading\">
						<span class=\"pageTitle\">".$pageTitle."</span>
						<span class=\"pageName\">".$pageName."</span>
						<span class=\"pageSendTime\">".$sendTime."</span>
						<span class=\"pageCookie\">ID:".$sendCookie."</span>
						<span class=\"pageTools\">
							<a href=\"./?b=".$_GET['b']."&r=".$pageID."\">No.".$pageID."</a>
							<div class=\"btn-group btn-group-xs\">
								<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-warning\"></i> 举报</button>
								<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-bookmark\"<!--bookmark-o--></i> 订阅</button>
							</div>
							<div class=\"btn-group btn-group-sm\">
								<button type=\"button\" class=\"btn btn-primary\" onclick=\"reply(".$pageID.",'".$block."');\">回复</button>
							</div>
						</span>
					</div>
					<div class=\"panel-body\">
						<div class=\"pageText\">
					    	".$img."		
					    	<div>
					    		<span>
					    		".$text."
								</span>	
					    	</div>
						</div>
					</div>
					".$allReply;
			if($reply != false){
				echo "<div class=\"well\"><ul class=\"list-group\">";
				$img = "";

				/*循环输出最新五个回复*/
				foreach (array_reverse($reply) as $replyData) {

					//楼层数
					$replyid = $replyData['floor'];

					//获取回复内容
					$replyText = $replyData['reply_text'];

					//判断是否有图片
					if($replyData['img_url'] != NULL){
						$img = "<img class=\"pageImg\" src=\"".$replyData['img_url']."\">";
					}else{
						$img = NULL;
					}

					//判断标题
					if($replyData["reply_title"] == NULL){
						$pageTitle = "无标题";
					}else{
						$pageTitle = $replyData['reply_title'];
					}

					//判断名字
					if($replyData["reply_name"] == NULL){
						$pageName = "无名氏";
					}else{
						$pageName = $replyData['reply_name'];
					}

					//输出
					echo "
					<li class=\"list-group-item\">
						<div class=\"replyInfo\">
							<span class=\"replyTitle\" class=\"panel-title\">".$pageTitle."</span>
					    	<span class=\"replyName\" class=\"panel-title\">".$pageName."</span>
					    	<span class=\"replySendTime\" class=\"panel-title\">".$replyData['reply_send_time']."</span>
					    	<span class=\"replyCookie\" class=\"panel-title\">ID:".$replyData['reply_send_cookie']."</span>
					    	<span class=\"replyTools\">
					    		<a href=\"javascript:;\">#".$replyid."</a>
						    	<div id=\"optionPage\" class=\"btn-group btn-group-xs\">
									<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-warning\"></i> 举报</button>
									<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-link\"></i> 引用</button>
								</div>
							</span>
						</div>
						<div class=\"replyText\">
					    	".$img."
					    	<div>
					    		<span>
					    		".$replyText."
								</span>	
					    	</div>
						</div>
						<div style=\"clear:both\"></div>
					</li>";
				}
			echo "</ul></div>";
			}
			echo "</div></div>";
		}
		//输出分页
		if(isset($_GET['p'])){
			LoopPagePagination($block,$_GET['p']);
		}else{
			LoopPagePagination($block,1);
		}
	}


	else if(isset($_GET['b']) && isset($_GET['r'])){
		
		//处理页数
		if(isset($_GET['p'])){
			$p = checkPage($_GET['r'],$_GET['p'],1);
		}else{
			$p = checkPage($_GET['r'],1,1);
		}
		
		$getPage = getPage($_GET['r']);
		foreach($getPage as $pageData){
			$pageName = "";
			$pageTitle = "";
			$allReply = "";
			$img = "";
			$sendTime = $pageData['page_send_time'];
			$sendCookie = $pageData['page_send_cookie'];
			$pageID = $pageData['id'];
			$text = str_replace("&lt;br/&gt;", "<br/>",$pageData['page_text']);
			$block = $pageData['block'];
			//获取page的id，用来获取该id的回复
			$reply = getReply($_GET['r'],$p);
			$replyFloor = i_array_column($reply, 'floor');
			//判断标题
			if($pageData["page_title"] == NULL){
				$pageTitle = "无标题";
			}else{
				$pageTitle = $pageData['page_title'];
			}

			//判断名字
			if($pageData["page_name"] == NULL){
				$pageName = "无名氏";
			}else{
				$pageName = $pageData['page_name'];
			}

			//判断是否有图片
			if($pageData['img_url'] != ""){
				$img = "<img class=\"pageImg\" src=\"".$pageData['img_url']."\">";
			}else if(count($reply) > 5){
				$img = "";
			}

			//输出
			echo "
			<div id=\"loopPage\">
				<div class=\"panel panel-info\">
					<div class=\"panel-heading\">
						<span class=\"pageTitle\">".$pageTitle."</span>
						<span class=\"pageName\">".$pageName."</span>
						<span class=\"pageSendTime\">".$sendTime."</span>
						<span class=\"pageCookie\">ID:".$sendCookie."</span>
						<span class=\"pageTools\">
							<a href=\"javascript:;\">No.".$pageID."</a>
							<div class=\"btn-group btn-group-xs\">
								<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-warning\"></i> 举报</button>
								<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-bookmark\"<!--bookmark-o--></i> 订阅</button>
							</div>
							<div class=\"btn-group btn-group-sm\">
								<button type=\"button\" class=\"btn btn-primary\" onclick=\"reply(".$pageID.",'".$block."');\">回复</button>
							</div>
						</span>
					</div>
					<div class=\"panel-body\">
						<div class=\"pageText\">
					    	".$img."		
					    	<div>
					    		<span>
					    		".$text."
								</span>	
					    	</div>
						</div>
					</div>
					".$allReply;
				if($reply != false){
					echo "<div class=\"well\"><ul class=\"list-group\">";
					

					foreach ($reply as $replyData) {
						$img = "";
						$replyid = $replyData['floor'];
						//判断是否有图片
						if($replyData['img_url'] != NULL){
							$img = "<img class=\"pageImg\" src=\"".$replyData['img_url']."\">";
						}else if(count($reply) > 5){
							$img = "";
						}

						//判断标题
						if($replyData["reply_title"] == NULL){
							$pageTitle = "无标题";
						}else{
							$pageTitle = $replyData['reply_title'];
						}

						//判断名字
						if($replyData["reply_name"] == NULL){
							$pageName = "无名氏";
						}else{
							$pageName = $replyData['reply_name'];
						}
						$replyText = str_replace("&lt;br/&gt;", "<br/>",$replyData['reply_text']);
						echo "
						<li class=\"list-group-item\">
							<div class=\"replyInfo\">
								<span class=\"replyTitle\" class=\"panel-title\">".$pageTitle."</span>
						    	<span class=\"replyName\" class=\"panel-title\">".$pageName."</span>
						    	<span class=\"replySendTime\" class=\"panel-title\">".$replyData['reply_send_time']."</span>
						    	<span class=\"replyCookie\" class=\"panel-title\">ID:".$replyData['reply_send_cookie']."</span>
						    	<span class=\"replyTools\">
						    		<a href=\"javascript:;\">#".$replyid."</a>
							    	<div id=\"optionPage\" class=\"btn-group btn-group-xs\">
										<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-warning\"></i> 举报</button>
										<button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-link\"></i> 引用</button>
									</div>
								</span>
							</div>
							<div class=\"replyText\">
						    	".$img."
						    	<div>
						    		<span>
						    		".$replyText."
									</span>	
						    	</div>
							</div>
							<div style=\"clear:both\"></div>
						</li>";
						$img = "";
					}
				echo "</ul></div>";

			}
			
			
			echo "</div></div>";

			//输出分页
			if(isset($_GET['p'])){
				LoopReplyPagination($_GET['b'],$_GET['r'],$_GET['p']);
			}else{
				LoopReplyPagination($_GET['b'],$_GET['r'],1);
			}
		}
	}else{
		exit();
	}
	
?>
<!--//3月12号目标——实现浏览帖子、回复帖子功能。
</br>//3月13号目标——实现分页功能、对程序变量进行注释和优化。(延迟)
</br>//3月13号实际实现了图片上传功能、发布回复功能使用jq form插件重写、匹配i标签提示功能、编辑框提示功能。
 </br></br>未来修改 or 实现：
</br>install页面
</br>在程序界面输出“无标题”等缺省值，还是在提交时处理好写入数据库。（前者是否导致处理时间变慢，后者是否导致数据库变大）
</br>置顶功能实现
</br>搜索功能实现
</br>标识楼主（加粗？另色？）
</br>导航栏“xx新帖”功能实现，新帖定义：当日0点之后发出的帖子进行统计（数据库开拓新表保存统计数据？）
</br>实现后台功能
</br>楼层引用
</br>首页显示
</br>对网页id class命名规范化
</br>url重写
</br>订阅功能，记录在cookie上，i标签变化bookmark-o or bookmark
</br>导航栏超出之后滚动条美化
</br>板块i标签数据库同步保存、并在页面上调用
</br>后台可定义范围宽广（例如提示等）
</br>提高安全性 -->