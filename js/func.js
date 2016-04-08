(function(e){function t(e,t,n){if(t=="show"){switch(n){case"fade":e.fadeIn();break;case"slide":e.slideDown();break;default:e.fadeIn()}}else{switch(n){case"fade":e.fadeOut();break;case"slide":e.slideUp();break;default:e.fadeOut()}}}e.goup=function(n){var r=e.extend({location:"right",locationOffset:20,bottomOffset:10,containerRadius:10,containerClass:"goup-container",arrowClass:"goup-arrow",alwaysVisible:false,trigger:500,entryAnimation:"fade",goupSpeed:"slow",hideUnderWidth:500,containerColor:"#000",arrowColor:"#fff",title:"",titleAsText:false,titleAsTextClass:"goup-text"},n);e("body").append('<div style="display:none" class="'+r.containerClass+'"></div>');var i=e("."+r.containerClass);e(i).html('<div class="'+r.arrowClass+'"></div>');var s=e("."+r.arrowClass);var o=r.location;if(o!="right"&&o!="left"){o="right"}var u=r.locationOffset;if(u<0){u=0}var a=r.bottomOffset;if(a<0){a=0}var f=r.containerRadius;if(f<0){f=0}var l=r.trigger;if(l<0){l=0}var c=r.hideUnderWidth;if(c<0){c=0}var h=/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i;if(h.test(r.containerColor)){var p=r.containerColor}else{var p="#000"}if(h.test(r.arrowColor)){var d=r.arrowColor}else{var d="#fff"}if(r.title===""){r.titleAsText=false}var v={};v={position:"fixed",width:40,height:40,background:p,cursor:"pointer"};v["bottom"]=a;v[o]=u;v["border-radius"]=f;e(i).css(v);if(!r.titleAsText){e(i).attr("title",r.title)}else{e("body").append('<div class="'+r.titleAsTextClass+'">'+r.title+"</div>");var m=e("."+r.titleAsTextClass);e(m).attr("style",e(i).attr("style"));e(m).css("background","transparent").css("width",80).css("height","auto").css("text-align","center").css(o,u-20);var g=e(m).height()+10;e(i).css("bottom","+="+g+"px")}var y={};y={width:0,height:0,margin:"0 auto","padding-top":13,"border-style":"solid","border-width":"0 10px 10px 10px","border-color":"transparent transparent "+d+" transparent"};e(s).css(y);var b=false;e(window).resize(function(){if(e(window).outerWidth()<=c){b=true;t(e(i),"hide",r.entryAnimation);if(m)t(e(m),"hide",r.entryAnimation)}else{b=false;e(window).trigger("scroll")}});if(e(window).outerWidth()<=c){b=true;e(i).hide();if(m)e(m).hide()}if(!r.alwaysVisible){e(window).scroll(function(){if(e(window).scrollTop()>=l&&!b){t(e(i),"show",r.entryAnimation);if(m)t(e(m),"show",r.entryAnimation)}if(e(window).scrollTop()<l&&!b){t(e(i),"hide",r.entryAnimation);if(m)t(e(m),"hide",r.entryAnimation)}})}else{t(e(i),"show",r.entryAnimation);if(m)t(e(m),"show",r.entryAnimation)}if(e(window).scrollTop()>=l&&!b){t(e(i),"show",r.entryAnimation);if(m)t(e(m),"show",r.entryAnimation)}e(i).on("click",function(){e("html,body").animate({scrollTop:0},r.goupSpeed);return false});e(m).on("click",function(){e("html,body").animate({scrollTop:0},r.goupSpeed);return false})}})(jQuery)
$(document).ready(function () {
    $.goup({
        trigger: 400,
        bottomOffset: 30,
        locationOffset: 30,
        title: '返回顶部',
        titleAsText: true
    });
});
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
		var send = $("#Send").attr("name");
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
                        threeSecRefresh();
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
        var send = $("#Reply").attr("name");
		var reply = $("#Reply").val();
		text = nl2br(text);
		$("#SendTextBox").ajaxSubmit({
            type:'post',
            url:Weburl+'/Module/post.php?type=reply',
            data: {title:title,text:text,reply:reply,send:send,name:name} ,
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
                        threeSecRefresh();
        				break;
        		}

        		$("#Reply").addClass("btn btn-primary");
            }
        });
	});
	
	$(function () { $("[data-toggle='tooltip']").tooltip(); });

    $('.pageImg').click(function (){
        var a = this.src;
        $(function () {
            $('#myModal').on('show.bs.modal', function () {
                $('#showpic').attr("src",a);
            })
        });
     });

    $(".rawpic").click(function (){
            window.open($('#showpic')[0].src);
        });
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