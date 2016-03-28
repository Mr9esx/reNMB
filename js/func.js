

$(document).ready(function () {
	
	var Weburl = getRootPath();
   // Weburl = Weburl.replace("\/\/","\/");
/*	alert(Weburl);*/
    $("#jquery-accordion-menu").jqueryAccordionMenu();

    $("#turnUp").click(function(){ 
        scrollTo(".logo",500); 
    }); 
	$('input[id=lefile]').change(function() {
		$('#photoCover').val($(this).val());
	});

	$("#Send").click(function(){
		$("#Send").addClass("btn btn-primary disabled");
		var title = $("#getTitle").val();
		var text = $("#editor").val();
		var send = $("#Send").val();
		var name = $("#getName").val();
		var file = $("#lefile").val();
		text = nl2br(text);
		$("#SendTextBox").ajaxSubmit({
            type:'post',
            url:Weburl+'/Module/post.php?type=send',
            data: {title:title,text:text,send:send,name:name},
            success:function(data){
            	var decode = JSON.parse(data);
            	
        		switch(decode.uploaderrorcode){
        			case "1":
        				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
        				break;
        			case "2":
        				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
        				break;
    				case "3":
	    				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
	    				break;
	    			case "0":
        				$("#picmsgBox").addClass("alert alert-success message").append(decode.uploadmsg);
        				break;
        		}

        		switch(decode.errorcode){
	    			case "0":
        				$("#msgBox").addClass("alert alert-success message").append(decode.msg+"两秒后自动刷新！");
        				threeSecRefresh();
        				break;
        			case "1":
        				$("#msgBox").addClass("alert alert-warning message").append(decode.msg);
        				threeSecRefresh();
        				break;
        			default:
        				$("#msgBox").addClass("alert alert-danger message").append(decode.msg+"提交失败！");
        				break;
        		}

        		$("#Send").addClass("btn btn-primary");

            }
        });
	});

	$("#Reply").click(function(){
		$("#Reply").addClass("btn btn-primary disabled");
		var title = $("#getTitle").val();
		var text = $("#editor").val();
		var name = $("#getName").val();
		var reply = $("#Reply").val();
		text = nl2br(text);
		$("#SendTextBox").ajaxSubmit({
            type:'post',
            url:Weburl+'/Module/post.php?type=reply',
            data: {title:title,text:text,reply:reply,name:name} ,
             success:function(data){
            	var decode = JSON.parse(data);
        		switch(decode.uploaderrorcode){
        			case "1":
        				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
        				break;
        			case "2":
        				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
        				break;
    				case "3":
	    				$("#picmsgBox").addClass("alert alert-warning message").append(decode.uploadmsg);
	    				break;
	    			case "0":
        				$("#picmsgBox").addClass("alert alert-success message").append(decode.uploadmsg);
        				break;
        		}

        		switch(decode.errorcode){
	    			case "0":
        				$("#msgBox").addClass("alert alert-success message").append(decode.msg+"两秒后自动刷新！");
        				threeSecRefresh();
        				break;
        			case "1":
        				$("#msgBox").addClass("alert alert-warning message").append(decode.msg);
        				threeSecRefresh();
        				break;
        			default:
        				$("#msgBox").addClass("alert alert-danger message").append(decode.msg+"提交失败！");
        				break;
        		}

        		$("#Reply").addClass("btn btn-primary");
            }
        });
	});
	
	$(function () { $("[data-toggle='tooltip']").tooltip(); });

});

function getRootPath() {
	var pathName = window.location.pathname.substring(1);
	var webName = pathName == '' ? '' : pathName.substring(0, pathName.indexOf('/'));
	//return window.location.protocol + '//' + window.location.host + '/'+ webName + '/';
	return window.location.protocol + '//' + window.location.host + '/'+ webName;
} 

function nl2br(text) 
{ 
	return text.replace(/\n/g,"<br/>"); 
} 

function reply(pageid,block){
	window.location.href="?b="+block+"&r="+pageid; 
}

function threeSecRefresh(){
	setTimeout(function () {
		window.location.reload();
	}, 2000);
}

function scrollTo(ele, speed){
	if(!speed) speed = 300;
	if(!ele){
		$("html,body").animate({scrollTop:0},speed);
	}else{
		if(ele.length>0) $("html,body").animate({scrollTop:$(ele).offset().top},speed);
	}
	return false;
}

function setEmoticons(obj) { 
	var getText = document.getElementById('Font');
	var obj = document.getElementById("editor");
	getText.onchange=function(){
	    var Text = this.options[this.selectedIndex].innerHTML;//获取option中间的文本
	    obj.value = obj.value+Text;
	}	
} 
function sendPage(){
/*	$.ajax({
		type: "POST",
		url: "post.php",
		data: "name=garfield&age=18",
		success:function(){
			alert("!");
		},
		async: false
	});*/
}