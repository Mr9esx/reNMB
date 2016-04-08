<?php
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'page_manage') {
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
	.managePageTitle{
		font-size: 1em;
		font-weight: 600;
	}
	.managePageName{
		font-size: 0.9em;
	}
	.managePageText{
		margin-top: 4px;
	}
	.managerSendTime,.managerSendCookie,.managerPageState{
		color: #888;
	}
	.pagination{
		margin-top: 0px !important;
	}
	.activeLI{
		border: 1px solid red;
	}
</style>
<div class="col-xs-2 column" style="">
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
				echo "<a href='".WEBROOTURL."/admin/?action=".$_GET['action']."&b=".$SonBlock."' class='list-group-item'>".$SonBlock."</a>";
			}
		}echo "</div>";
	
	if(isset($_GET['b'])){
		$manageblock = $_GET['b'];
		if(isset($_GET['p'])){
			$p = checkPage($manageblock,$_GET['p'],0,20);
		}else{
			$p = checkPage($manageblock,1,0,20);
		}
	}
	?></div>
</div>

   <script>
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>
<div>
<div class="col-md-10 column">
	
		<?php
			if(isset($_GET['b'])){
				if(!isblock($manageblock)){
					exit();
				}
				echo "	<div class='page-header'>
						   	<h4>".$_GET['b']." - 帖子列表</h4>
						</div>";

				if(isset($_GET['p'])){
					LoopManagePagePagination($manageblock,$_GET['p']);
				}else{
					LoopManagePagePagination($manageblock,1);
				}

				echo "<div style='float:right;width:30%;' class='input-group'>
               <input type='text' class='form-control'>
               <span class='input-group-btn'>
                  <button class='btn btn-default' type='button'>
                     搜索帖子
                  </button>
               </span>

            </div><!-- /input-group -->

						<table class='table table-hover'>
							<colgroup>
							    <col width='5%'></col>
							    <col width='47%'></col>
							    <col width='5%'></col>
							    <col width='14%'></col>
							    <col width='10%'></col>
							    <col width='5%'></col>
							    <col width='11%'></col>
							    <col width='3%'></col>
						    </colgroup>
							<thead>
								<tr>
									<th>ID</th>
									<th>帖子内容</th>
									<th>图片</th>
									<th>发表时间</th>
									<th>发表饼干</th>
									<th>状态</th>
									<th>操作</th>
									<th>多选</th>
								</tr>
							</thead>
							<tbody>";
				$loopPage = loopPage($manageblock,$p,20);
				//print_r($loopPage);
				$style = $state = $pic_state = $btn_pic = '';
				foreach($loopPage as $pageData){
					switch ($pageData['is_sega']) {
						case 0:
							$state = 'Okay';
							break;
						case 1:
							$state = 'Sega';
							$style = "warning";
							break;
					}
					echo "<tr id='".$pageData['id']."' class='".$style."'><td class='pageid'>".$pageData['id']."</td><td><div>
					<div class='managePageTitle'><a href='".WEBROOTURL."/?b=".$pageData['block']."&r=".$pageData['id']."'>".$pageData['page_title']."</a></div>
					<span class='managePageName'>".$pageData['page_name']."</span><div class='managePageText'>".$text = str_replace("&lt;br/&gt;", "<br/>",$pageData['page_text'])."</div>";
					if($pageData['img_url'] == NULL){
						echo "
						<td class='managePagePic'>
      						<button type='button' class='btn btn-warning btn-xs' onclick='window.open('".$pageData['img_url']."','_blank')'>无图</button>
  						</td>";
					}else{
						echo "
						<td class='managePagePic'>
							<p class='tooltip-options'>
      							<a href='#' data-toggle='tooltip' title='<img style='width:96px' src='".$pageData['img_url']."'>
      								<button type='button' class='btn btn-info btn-xs' onclick='window.open('".$pageData['img_url']."','_blank')'>查看</button>
     							 </a>
  							</p>
  						</td>";
					}
					

					echo "<td class='managerSendTime'>".$pageData['page_send_time']."</td><td class='managerSendCookie'>".$pageData['page_send_cookie']."</td><td class='managerPageState'>".$state."</td>";

					echo "<td class='managerPageController'>";
					switch ($pageData['is_sega']) {
						case 0:
							echo "<button type='button' class='sega btn btn-warning btn-xs' value='".$pageData['id']."'>Sega</button>  ";
							break;
						case 1:
							echo "<button type='button' class='nobo btn btn-info btn-xs' value='".$pageData['id']."'>Nobo</button>  ";
							break;
					}
					echo "<button type='button' class='deletePage btn btn-danger btn-xs' value='".$pageData['id']."' data-toggle='modal' data-target='#myModal'>删除</button></td>";
					echo "<td><span><input name='pagecheckbox' value='".$pageData['id']."' type='checkbox'><span></td></tr>";

					$style = $state = $pic_state = $btn_pic = '';
				}
				echo "</tbody></table>";
echo "<button data-toggle='modal' data-target='#myModal'  type='button' class='pagecheckbox btn btn-danger pull-right'>删除多选</button>";
				if(isset($_GET['p'])){
					LoopManagePagePagination($manageblock,$_GET['p']);
				}else{
					LoopManagePagePagination($manageblock,1);
				}
			}else{
				echo "<div class='page-header'>
						   	<h4>今日帖子概览</h4>
						</div>";
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