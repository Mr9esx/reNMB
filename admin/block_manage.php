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
		padding: 14px 0px 14px 0px !important;
	}
	table{
		text-align: center;
	}
</style>
<div class="col-md-12 column">
	<div class="page-header">
	   	<h4>全部版块</h4>
	</div>
	<table class="table table-hover">
		<colgroup>
		    <col width='10%'></col>
		    <col width='10%'></col>
		    <col width='25%'></col>
		    <col width='25%'></col>
		    <col width='30%'></col>
		</colgroup>
	   <thead>
	      <tr>
	         <th>ID</th>
	         <th>Logo</th>
	         <th>父版块</th>
	         <th>子版块</th>
	         <th>操作</th>
	      </tr>
	   </thead>
	   <tbody>
	      <tr>
	         <td>1</td>
	         <td><i class="fa fa-gamepad"></i></td>
	         <td>综合</td>
	         <td>综合版</td>
	         <td><button type="button" class="btn btn-danger btn-xs">删除版块</button> <button type="button" class="btn btn-info btn-xs">查看版块</button></td>
	      </tr>
	      <tr>
	         <td>1</td>
	         <td ><i class="fa fa-gamepad"></i></td>
	         <td>综合</td>
	         <td>综合版</td>
	         <td><button type="button" class="btn btn-danger btn-xs">删除版块</button> <button type="button" class="btn btn-info btn-xs">查看版块</button></td>
	      </tr>
	      <tr>
	         <td>1</td>
	         <td><i class="fa fa-gamepad"></i></td>
	         <td>综合</td>
	         <td>综合版</td>
	         <td><button type="button" class="btn btn-danger btn-xs">删除版块</button> <button type="button" class="btn btn-info btn-xs">查看版块</button></td>
	      </tr>
	   </tbody>
	</table>
</div>
<div class="col-md-12 column">
	<form class="bs-example bs-example-form" role="form">
    	<div class="row">
			<div class="col-lg-3">
	            <div class="input-group">
	               <span class="input-group-btn">
	                  <button class="btn btn-default" type="button">
	                     板块Logo
	                  </button>
	               </span>
	               <input type="text" class="form-control">
	            </div><!-- /input-group -->
	         </div>
			<div class="col-lg-4">
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						 选择已有父版块 
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">功能</a></li>
							<li><a href="#">另一个功能</a></li>
							<li><a href="#">其他</a></li>
							<li class="divider"></li>
							<li><a href="#">分离的链接</a></li>
						</ul>
					</div><!-- /btn-group -->
					<input type="text" class="form-control">
				</div><!-- /input-group -->
			</div>
			<div class="col-lg-4">
	            <div class="input-group">
	               <span class="input-group-btn">
	                  <button class="btn btn-default" type="button">
	                    子版块
	                  </button>
	               </span>
	               <input type="text" class="form-control">
	            </div><!-- /input-group -->
	         </div>
	         <button type="button" class="btn btn-info">创建版块</button>
		</div>

   </form>
</div>