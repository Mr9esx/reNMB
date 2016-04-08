$(document).ready(function () {
    $("#loginbtn").click(function(){
    	var user = $('#user').val();
    	var password = $('#password').val();
    	var sevendaylogin = $("input[type='checkbox']").is(':checked');
    	$.ajax({
            type:'POST',
            data: {user:user,password:password,sevendaylogin:sevendaylogin},
            url:getRootPath()+'/admin/controller.php?action=login',//请求数据的地址
            success:function(data){
	    		switch(data){
	                case "1":
	                    $('#msg').html("登陆失败！");
	                    break;
	                case "0":
	                    $('#msg').html("登陆成功！<a href='"+getRootPath()+"/admin'>点击转到后台！</a>");
	                    break;
	            }
            	
            }
        });
    });
});

function getRootPath() {
    var pathName = window.location.pathname.substring(1);
    var webName = pathName == '' ? '' : pathName.substring(0, pathName.indexOf('/'));
    //return window.location.protocol + '//' + window.location.host + '/'+ webName + '/';
    return window.location.protocol + '//' + window.location.host + '/'+ webName;
} 