<?php
	if(isset($_GET['action'])){
		require_once ('func.php');
	}else{
		exit();
	}

?>
<div class="row clearfix" style="margin-bottom:20px">
	<div class="col-md-6 column">
		<div id="ServerDiskUsedStyle">
			<div class="ServerTitle">服务器硬件信息</div>
			<ul class="list-group">
			   <li class="list-group-item">CPU型号：<br/>
					<?php echo $sysInfo['cpu']['model']?></li>
			   <li class="list-group-item">内存大小：
			   		<?php echo $mt?></li></li>
			   <li class="list-group-item">硬盘大小：
			   		<?php echo $dt;?> GB</li>
			   <li class="list-group-item">24*7 支持</li>
			</ul>

		</div>
	</div>
	<div class="col-md-3 column" >
		<div id="ServerDiskUsedStyle">
			<div class="ServerTitle">服务器参数</div>
		</div>
	</div>
	<div class="col-md-3 column" >
		<div id="ServerDiskUsedStyle">
			<div class="ServerTitle">服务器硬盘使用率</div>
			<div style="height:200px" id="ServerDiskUsed"></div>
		</div>
	</div>
	<div class="col-md-6 column">
		
	</div>
</div>

<div class="row clearfix"><div class="col-md-6 column">
		<div style="height:240px" id="ServerCPUUsed"></div>
	</div>
	<div class="col-md-6 column">
		<div style="height:240px" id="ServerMemoryUsed"></div>
	</div>
	
</div>