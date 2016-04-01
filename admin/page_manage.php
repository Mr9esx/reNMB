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
	td{
		max-width: 10% !important;
	}
	tr{
		background-color: #fff !important;
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
</style>
<div class="col-md-2 column">
	<div class="page-header">
	   	<h4>版块选择</h4>
	</div>
	<?php
	echo "<div>";
	foreach (getFatherMenu() as $FatherBlock){ 
		$SonBlock = getSonMenu($FatherBlock);
		echo "<a class=\"list-group-item active\">".$FatherBlock."</a>";
		foreach ($SonBlock as $SonBlock){
			echo "<a  href=\"".WEBROOTURL."/admin/?action=".$_GET['action']."&b=".$SonBlock."\" class=\"list-group-item\">".$SonBlock."</a>";
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
	?>
</div>

<div class="col-md-10 column">
	<div class="page-header">
	   	<h4>帖子列表</h4>
	</div>
	

	<table class="table">
		<colgroup>
		    <col width='5%'></col>
		    <col width='50%'></col>
		    <col width='5%'></col>
		    <col width='14%'></col>
		    <col width='10%'></col>
		    <col width='5%'></col>
		    <col width='11%'></col>
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
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($_GET['b'])){
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
					echo "<tr class=\"".$style."\"><td class=\"pageid\">".$pageData['id']."</td><td><div>
					<div class=\"managePageTitle\"><a href=\"".WEBROOTURL."/?b=".$pageData['block']."&r=".$pageData['id']."\">".$pageData['page_title']."</a></div>
					<span class=\"managePageName\">".$pageData['page_name']."</span><div class=\"managePageText\">".$pageData['page_text']."</div>";
					if($pageData['img_url'] == NULL){
						$btn_pic = "无图";
						$pic_state = "btn-warning";
					}else{
						$btn_pic = "查看";
						$pic_state = 'btn-info';
					}
					echo "<td class=\"managePagePic\"><button type=\button\" class=\"btn ".$pic_state." btn-xs\" onclick=\"window.open('".$pageData['img_url']."','_blank')\">".$btn_pic."</button></td>";

					echo "<td class=\"managerSendTime\">".$pageData['page_send_time']."</td><td class=\"managerSendCookie\">".$pageData['page_send_cookie']."</td><td class=\"managerPageState\">".$state."</td>";

					echo "<td class=\"managerPageController\">";
					switch ($pageData['is_sega']) {
						case 0:
							echo "<button type=\"button\" class=\"sega btn btn-warning btn-xs\" value=\"".$pageData['id']."\">Sega</button>  ";
							break;
						case 1:
							echo "<button type=\"button\" class=\"nobo btn btn-info btn-xs\" value=\"".$pageData['id']."\">Nobo</button>  ";
							break;
					}
					echo "<button type=\"button\" class=\"delete btn btn-danger btn-xs\" value=\"".$pageData['id']."\">删除</button></td></tr>";
					$style = $state = $pic_state = $btn_pic = '';
				}
			}
		?>
		</tbody>
	</table>
	<?php
	if(isset($_GET['b'])){
		if(isset($_GET['p'])){
			LoopManagePagePagination($manageblock,$_GET['p']);
		}else{
			LoopManagePagePagination($manageblock,1);
		}
	}
	?>
</div>