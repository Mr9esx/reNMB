<?php
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'website_config') {
			require_once ('../Module/func.php');
		}
	}else{
		exit();
	}
?>
<style>
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
</style>
<div class="col-md-2 column">
	<div class="blocknav" style="width: 160px;">
		<div class="page-header">
		   	<h4>版块选择</h4>
		</div>
		<div>
			<a class="list-group-item active">网站基础设置</a>
			<a href="javascript:;" class="list-group-item cookie">关闭饼干</a>
		</div>		
	</div>
</div>

<div>
<div class="col-md-10 column" style="height:1000px;">
		
</div>
<div id="cookie_main" class="page-header">
   	<h4>版块选择</h4>
</div>
<div>
	<a class="list-group-item active">网站基础设置</a>
	<a href="javascript:;" class="list-group-item cookie">关闭饼干</a>
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