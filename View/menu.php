
		<div id="menu">

			<!--Logo标题-->
			<div id="WebTitleBox">
				<div id="WebTitle">匿名版</div>
			</div>
			<!--Logo标题-->
	
			<!--搜索框-->
			<div id="search" class="input-group">
				<input type="text" class="form-control" placeholder="懒癌发作，还没做"/>
               <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                     <i class="fa fa-search"></i> 搜索
                  </button>
               </span>
			</div>
			<!--搜索框-->
			<!--菜单导航-->
			<div id="jquery-accordion-menu" class="jquery-accordion-menu">
				<ul id="demo-list">
			<?php
			foreach (getFatherMenu() as $FatherBlock){ 
				$SonBlock = getSonMenu($FatherBlock);
				echo "<li><a href='javascript:;'><i class='".$FatherBlock['menu_father_zh_logo']."'></i>".$FatherBlock['menu_father_zh_name']."<span class='jquery-accordion-menu-label'>".count($SonBlock)."版块</span></a><ul class='submenu'>";
				foreach ($SonBlock as $SonBlock){
					$TodaySendCount = getTodaySendPageCount($SonBlock);
					echo "<li><a href='".WEBROOTURL."\?b=".$SonBlock."'>".$SonBlock."<span title='今天投稿' class='badge pull-righ'>".$TodaySendCount."新帖</span></a></li>";
				}
				echo "</ul></li>";
			}
			?>                             
	            </ul>
			</div>
			<!--菜单导航-->

			<!--菜单页脚-->
			<div id="footer">
				
			</div>
			<!--菜单页脚-->

		<div>
	</div>
</div>
