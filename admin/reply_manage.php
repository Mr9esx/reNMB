<?php
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'reply_manage') {
			require_once ('../Module/func.php');
		}
	}else{
		exit();
	}
?>
<style>
	th{
		text-align: center;
		padding: 11px 0px 11px 0px !important;
	}
	.list-group-item.active{
		background-color: #e7e7e7;
		border-color: #e7e7e7;
		color: #000;
	}
	.list-group-item.active:hover{
		background-color: #e7e7e7;
		border-color: #e7e7e7;
		color: #000;
	}
	.pageid{
		text-align: center;
	}
	.manageReplyFrom{
		padding: 4px 0px 4px 0px;
		text-align: center;
		background-color: #eee;
		border-radius: 6px;
	}
	.manageReplyTitle{
		margin-top: 4px;
		font-size: 1em;
		font-weight: 600;
	}
	.manageReplyName{
		font-size: 0.9em;
	}
	.manageReplyText{
		margin-top: 4px;
	}
	.managerSendTime,.managerSendCookie{
		color: #888;
	}
	.pagination{
		margin-top: 0px !important;
	}
	.controllerBox{
		margin-top: 4px;
	}
</style>
<div class="col-md-2 column">
	<div class='blocknav'>
		<div class="page-header">
		   	<h4>版块选择</h4>
		</div>
		<?php
		echo "<div>";
		foreach (getFatherMenu() as $FatherBlock){ 
			$SonBlock = getSonMenu($FatherBlock);
			echo "<a class='list-group-item active'>".$FatherBlock."</a>";
			foreach ($SonBlock as $SonBlock){
				echo "<a  href='".WEBROOTURL."/admin/?action=".$_GET['action']."&b=".$SonBlock."' class='list-group-item'>".$SonBlock."</a>";
			}
		}echo "</div>";
		?>
	</div>
</div>

   <script>
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>
<div>
<div class="col-md-10 column">
	
		<?php
		if(isset($_GET['b'])){

				$manageblock = $_GET['b'];
				if(!isblock($manageblock)){
					exit();
				}
				/**分页*/
				$loop = '';
				$pagecount = getAllReplyCount($_GET['b']);
				if($pagecount%20 != 0){
					$loop = 1;
					$pagecount = $pagecount - ($pagecount%20);
				}
				echo "	<div class='page-header'>
						   	<h4>".$_GET['b']." - 回复列表</h4>
						</div>";
				$loop = $loop + ($pagecount/20);
				LoopPagination($_GET['b'],$loop);
				/**分页*/

				echo "<div style='float:right;width:30%;' class='input-group'>
               <input type='text' class='form-control'>
               <span class='input-group-btn'>
                  <button class='btn btn-default' type='button'>
                     搜索回复
                  </button>
               </span>

            </div><!-- /input-group -->

						<table class='table table-hover'>
							<colgroup>
							    <col width='20%'></col>
							    <col width='47%'></col>
							    <col width='5%'></col>
							    <col width='10%'></col>
							    <col width='10%'></col>
							    <col width='5%'></col>
							    <col width='3%'></col>
						    </colgroup>
							<thead>
								<tr>
									<th>回复至</th>
									<th>回复内容</th>
									<th>图片</th>
									<th>发表时间</th>
									<th>发表饼干</th>
									<th>操作</th>
									<th>多选</th>
								</tr>
							</thead>
							<tbody>";

				if(isset($_GET['p'])){
					$p = checkPage($manageblock,$_GET['p'],0,10);
				}else{
					$p = checkPage($manageblock,1,0,10);
				}
				$loopReply = getBlockAllReply($manageblock,$p,20);

				foreach($loopReply as $replyData){
					$page = getPage($replyData['reply_for']);
					//print_r($page);
					if($page == NULL){
						echo "<tr class='danger'>";
					}else{
						echo "<tr>";
					}
					
					if($page == NULL || $page[0]['is_sega']){
						echo "<td class='warning'>";
					}else{
						echo "<td>";
					}

					echo 
					"<div class='manageReplyFrom'><span>".$replyData['block']." / </span><a href='".WEBROOTURL."/?b=".$replyData['block']."&r=".$replyData['reply_for']."'>No.".$replyData['reply_for']."</a></div>";

					if($page == NULL){
						echo
						"<div class='manageReplyTitle'>该帖子已被删除</div>
					</td>";
					}else{					
						
						echo
							"<div class='manageReplyTitle'><a href='".WEBROOTURL."/?b=".$replyData['block']."&r=".$replyData['reply_for']."'>".$page[0]['page_title']."</a></div>
							<div class='manageReplyName'>".$page[0]['page_name']."</div>
							<div class='manageReplyText'>".$text = str_replace("&lt;br/&gt;", "<br/>",$page[0]['page_text'])."</div>
						";

						echo "<div class='controllerBox'><a href='".WEBROOTURL."/admin/?action=page_manage&b=".$replyData['block']."&r=".$replyData['reply_for']."'><button type='button' class='delete btn btn-primary btn-xs' value=''>管理</button></a> ";
						
						switch ($page[0]['is_sega']) {
							case 0:
								echo "<button type='button' class='sega btn btn-warning btn-xs'  value='".$replyData['reply_for']."'>Sega</button>  ";
								break;
							case 1:
								echo "<button type='button' class='nobo btn btn-info btn-xs'  value='".$replyData['reply_for']."'>Nobo</button>  ";
								break;
						}

						//echo "<button type='button' class='delete btn btn-danger btn-xs' value=''>删除</button></div>";
						
						echo "</td>";
					}

					

					echo
					"<td>
						<div class='manageReplyTitle'><a href='javascript:;'>".$replyData['reply_title']."</a></div>
						<div class='manageReplyName'>".$replyData['reply_name']."</div>
						<div class='manageReplyText'>".$text = str_replace("&lt;br/&gt;", "<br/>",$replyData['reply_text'])."</div>
					</td>";

					if($replyData['img_url'] == NULL){
						echo "
						<td class='managePagePic'>
      						<button type=\button' class='btn btn-warning btn-xs' onclick='window.open('".$replyData['img_url']."','_blank')'>无图</button>
  						</td>";
					}else{
						echo "
						<td class='managePagePic'>
							<p class='tooltip-options'>
      							<a href='#' data-toggle='tooltip' title='<img style='width:96px' src='".$replyData['img_url']."'>
      								<button type='button' class='btn btn-info btn-xs' onclick='window.open('".$replyData['img_url']."','_blank')'>查看</button>
     							 </a>
  							</p>
  						</td>";
					}

					echo 
					"<td class='managerSendTime'>2016-04-01 19:32:38</td>
					<td class='managerSendCookie'>sso3lpsq4</td>
					<td><button type='button' class='deleteReply btn btn-danger btn-xs' value='".$replyData['id']."' data-toggle='modal' data-target='#myModal'>删除</button></td>";
					echo "<td><span><input name='replycheckbox' value='".$replyData['id']."' type='checkbox'><span></td></tr>";
				}

				echo "</tbody></table>";
				echo "<button data-toggle='modal' data-target='#myModal'  type='button' class='replycheckbox btn btn-danger pull-right'>删除多选</button>";
				LoopPagination($_GET['b'],$loop);
			}else{
				echo "<div class='page-header'>
						   	<h4>今日回复概览</h4>
						</div>";
			}

	//输出分页
	function LoopPagination($block,$count){

		$p = 1;
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

		echo "<ul class='pagination'>";
		echo "<li><a href='?action=reply_manage&b=".$block."&p=1'>首页</a></li>";

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
			echo "<li><a href='?action=reply_manage&b=".$block."&p=".($p - 1)."'>上一页</a></li>";
		}
		for($before;$before < $p;$before++){
			echo "<li><a href='?action=reply_manage&b=".$block."&p=".$before."'>".$before."</a></li>";
		}
		echo "<li class='active'><a href='?action=reply_manage&b=".$block."&p=".$p."'>".$p."</a></li>";

		if($tmp != $count){
			for($tmp;$tmp < $after;$tmp){
				echo "<li><a href='?action=reply_manage&b=".$block."&p=".++$tmp."'>".$tmp."</a></li>";
			}
		}

		if($p != $count){
			echo "<li><a href='?action=reply_manage&b=".$block."&p=".($p + 1)."'>下一页</a></li>";
		}		
		echo "</ul>";
	}
		?>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               确认删除？
            </h4>
         </div>
         <div>
            <div class="modal-body"></div>
            <div style="margin:0 10px 15px 10px" class="alert ">
			   <strong></strong>
			   <span></span>
			</div>
         </div>
         <div class="modal-footer">

            <button id="yes" type="button" class="btn btn-danger">
            	确认
            </button>
            <button type="button" class="btn btn-info" data-dismiss="modal">
               取消
            </button>
         </div>
      </div>
</div>