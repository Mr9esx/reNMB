<?php
	if (isset($_GET['b']) && defined('IN_SYS')) {

	}else{
		echo "非法访问！";
		exit();
	}
?>
<div id="textEditor">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">
		        <?php
					if(isset($_GET['b']) && !isset($_GET['r'])){
						echo $_GET['b']." - 发布新串";
					}else if(isset($_GET['b']) && isset($_GET['r'])){
						echo "回复 No.".htmlspecialchars($_GET['r']);
						
					}
				?>
		        <div id="cookieShow"  data-toggle="tooltip" data-placement="top" title="发贴之后才能领取饼干！如发贴失败请检查浏览器是否禁用Cookie">当前饼干：
			        <?php
			        	if(!isset($_COOKIE["renmbCookies"])){
			        		echo "尚未领取饼干";
			        	}else{
			        		echo getcookies($_COOKIE["renmbCookies"]);
			        	}
			        ?>
		        </div>
	    	</h3>
	    </div>
	    <div class="panel-body">
	    	<form role="form" id="SendTextBox" method="post" action="#" enctype="multipart/form-data">
				<div id="editorBox" class="form-group">
					<!--标题-->
				    <div id="textTitle" class="input-group">
				        <span class="input-group-addon" data-toggle="tooltip" data-placement="right" title="本文标题(默认：无标题)">标题</span>
				        <input type="text" class="form-control" id="getTitle">
				   	</div>
					<!--标题-->

					<!--编辑框-->
					<div>
					    <label style="margin-top:6px;font-size:1.1em;" for="editor">正文</label>
					    <textarea id="editor" class="form-control" placeholder="• 和平讨论，理性发言&#10;• 禁色情，露点图删，推广链接拉黑，严禁张贴他人隐私资料&#10;• 请文明讨论，人身攻击、辱骂内容一律砍+没收饼干&#10;• 文章字数不能少于五个汉字或者五个字符&#10;• 发布间距为15秒"></textarea>
					</div>
					<!--编辑框-->

					<!--工具箱-->
				    <div id="toolsBox">	
				    	<!--名字-->
				    	<div id="sendName" class="input-group">
					        <span class="input-group-addon"  data-toggle="tooltip" data-placement="top" title="您的称呼(默认：无名氏)"><i class="fa fa-user"></i> 姓名</span>
					        <input type="text" class="form-control" id="getName"/>
					   	</div>
				    	<!--名字-->	

						<!--颜文字-->
					    <div id="emoticons" class="input-group">
					        <span class="input-group-addon"  data-toggle="tooltip" data-placement="top" title="适当添加一些颜文字不仅能活化文字，还能让语气变得平滑喔"><i class="fa fa-smile-o"></i> 颜文字</span>
					        <select onclick="setEmoticons(this)" id="Font" class="form-control">
					        	<option selected="selected"  value=""></option>
						        <option value="1">(｡・`ω´･)</option>
						        <option value="2">_(:3 」∠)_</option>
						        <option value="3">(´・ω・`)</option>
						        <option value="4">(´・ω・)ﾉ</option>
						        <option value="5">≖‿≖✧</option>
						    </select>
					   	</div>
						<!--颜文字-->	

						<!--图片上传-->
						<div class="input-group" id="fileUpload">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="只支持格式为jpg、png、gif且大小不超过3MB的图片"><i class="fa fa-file-photo-o"></i> 图片上传</span>
			            		<input id="lefile" type="file" style="display:none" name="picFile"/>
								<input id="photoCover" type="text" class="form-control" type="text" name="picName"/>
			            	<span class="input-group-btn">
				                <button onclick="$('input[id=lefile]').click();" class="btn btn-default" type="button">
				                浏览
				                </button>
			               	</span>
			            </div>
						<!--图片上传-->

						<?php
							if(isset($_GET['b']) && !isset($_GET['r'])){
								echo "<button id=\"Send\" class=\"btn btn-primary\" type=\"button\" name=\"".$_GET['b']."\" value=\"".$_GET['b']."\">发布</button>";
							}else if(isset($_GET['b']) && isset($_GET['r'])){
								echo "<button id=\"Reply\" class=\"btn btn-primary\"type=\"button\" name=\"".$_GET['b']."\" value=\"".$_GET['r']."\">回复</button>";
							}
						?>
			            
					</div>
					<!--工具箱-->
				</div>
			</form>
			<!--信息框-->
				<div id="msgBox"></div>
				<div id="picmsgBox"></div>
			<!--信息框-->
		</div>
	</div>
</div>