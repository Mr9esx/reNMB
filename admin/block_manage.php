<?php
	if(isset($_GET['action'])){
		if ($_GET['action'] == 'block_manage') {
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
	   	<?php
	   		$database = connMySQL();
	   		$menu = $database->select("nmb_menu",["id","menu_father_menu_name","menu_son_menu_name","menu_father_menu_logo"]);
	   		foreach ($menu as $each){ 
	   			echo "
	   			<tr><td>".$each['id']."</td>
				<td><i class='".$each['menu_father_menu_logo']."'></i></td>
				<td>".$each['menu_father_menu_name']."</td>
				<td>".$each['menu_son_menu_name']."</td>
				<td><button type='button' value='".$each['menu_son_menu_name']."' class='delectblock btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal'>删除版块</button> <a href='".WEBROOTURL."/?b=".$each['menu_son_menu_name']."'><button type='button' class='btn btn-info btn-xs'>查看版块</button></a></td>
	   			</tr>";
			}
		?>
	   </tbody>
	</table>
</div>
<div class="col-md-12 column">
	<div class="page-header">
		<h4>创建版块</h4>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					 选择已有父版块或直接输入新父版块名称
					<span class="caret"></span>
					</button>
					<ul value='1' class="dropdown-menu">
					<?php
						foreach (getFatherMenu() as $FatherBlock){ 
							echo "<li value='".$FatherBlock."'><a class='fatherblock' value='".$FatherBlock."' href='javascript:;'>".$FatherBlock."</a></li>";
						}
					?>
					</ul>
				</div><!-- /btn-group -->
				<input type="text" class="fatherblockText form-control">
			</div><!-- /input-group -->
		</div>
		<div class="col-xs-5">
            <div class="input-group">
               <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    子版块名称
                  </button>
               </span>
               <input type="text" class="sonblockText form-control">
            </div><!-- /input-group -->
        </div>
        <div class="col-xs-2">
         	<div class="input-group">
         		<button  type="button" class="createblock btn btn-primary" data-toggle='modal' data-target='#myModal'>创建版块</button>
         	</div>
        </div>
	</div>
</div>
<div class="col-md-12 column">
	<div class="page-header">
		<h4>修改父版块图标</h4>
		<small>格式为：fa fa-xxxx。默认为：fa fa-mars。可参考<a href="http://9iphp.com/fa-icons">FontAwesome 4.4.0完整的585个图标样式</a>。</small>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						选择要修改的父版块
					<span class="caret"></span>
					</button>
					<ul value='1' class="dropdown-menu">
					<?php
						foreach (getFatherMenu() as $FatherBlock){ 
							echo "<li value='".$FatherBlock."'><a class='changefatherblock' value='".$FatherBlock."' href='javascript:;'>".$FatherBlock."</a></li>";
						}
					?>
					</ul>
				</div><!-- /btn-group -->
				<input type="text" class="fatherblocklogoText form-control">
			</div><!-- /input-group -->
		</div>
		<div class="col-xs-5">
            <div class="input-group">
               <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    图标代码
                  </button>
               </span>
               <input type="text" class="fatherblocklogo form-control">
            </div><!-- /input-group -->
        </div>
        <div class="col-xs-2">
         	<div class="input-group">
         		<button  type="button" class="changefatherblocklogo btn btn-primary" data-toggle='modal' data-target='#myModal'>修改图标</button>
         	</div>
        </div>
	</div>
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
               确定新建版块？
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