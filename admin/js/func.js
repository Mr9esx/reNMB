(function(e){"use strict";e.fn.pin=function(t){var n=0,r=[],i=false,s=e(window);t=t||{};var o=function(){for(var n=0,o=r.length;n<o;n++){var u=r[n];if(t.minWidth&&s.width()<=t.minWidth){if(u.parent().is(".pin-wrapper")){u.unwrap()}u.css({width:"",left:"",top:"",position:""});if(t.activeClass){u.removeClass(t.activeClass)}i=true;continue}else{i=false}var a=t.containerSelector?u.closest(t.containerSelector):e(document.body);var f=u.offset();var l=a.offset();var c=u.offsetParent().offset();if(!u.parent().is(".pin-wrapper")){u.wrap("<div class='pin-wrapper'>")}var h=e.extend({top:60,bottom:0},t.padding||{});u.data("pin",{pad:h,from:(t.containerSelector?l.top:f.top)-h.top,to:l.top+a.height()-u.outerHeight()-h.bottom,end:l.top+a.height(),parentTop:c.top});u.css({width:u.outerWidth()});u.parent().css("height",u.outerHeight())}};var u=function(){if(i){return}n=s.scrollTop();var o=[];for(var u=0,a=r.length;u<a;u++){var f=e(r[u]),l=f.data("pin");if(!l){continue}o.push(f);var c=l.from-l.pad.bottom,h=l.to-l.pad.top;if(c+f.outerHeight()>l.end){f.css("position","");continue}if(c<n&&h>n){!(f.css("position")=="fixed")&&f.css({left:f.offset().left,top:l.pad.top}).css("position","fixed");if(t.activeClass){f.addClass(t.activeClass)}}else if(n>=h){f.css({left:"",top:h-l.parentTop+l.pad.top}).css("position","absolute");if(t.activeClass){f.addClass(t.activeClass)}}else{f.css({position:"",top:"",left:""});if(t.activeClass){f.removeClass(t.activeClass)}}}r=o};var a=function(){o();u()};this.each(function(){var t=e(this),n=e(this).data("pin")||{};if(n&&n.update){return}r.push(t);e("img",this).one("load",o);n.update=a;e(this).data("pin",n)});s.scroll(u);s.resize(function(){o()});o();s.load(a);return this}})(jQuery)

$(document).ready(function(){

/*    $(function () {                                                                     
        $(document).ready(function() {                                                  
            Highcharts.setOptions({                                                     
                global: {                                                               
                    useUTC: false                                                       
                }                                                                       
            });                                                                         
                                                                                        
            var chart;                                                                  
            $('#ServerCPUUsed').highcharts({                                                
                chart: {                                                                
                    type: 'spline',                                                     
                    animation: Highcharts.svg, // don't animate in old IE               
                    marginRight: 10,                                                    
                    events: {                                                           
                        load: function() {                                                          
                            var series = this.series[0];  
                            var x,y;     
                            setInterval(function() {
                             $.ajax({
                                type:'GET',
                                url:'?type=cpu',//请求数据的地址
                                success:function(data){    
                                    tmp = parseFloat(data);
                                    x = (new Date()).getTime(),y = tmp; 
                                }
                            });                                      
                                                                 
                                series.addPoint([x, y], true, true);                    
                            }, 1000);                                                   
                        }                                                               
                    }                                                                   
                },                                                                      
                title: {                                                                
                    text: '服务器处理器平均负载'                                            
                },                                                                      
                xAxis: {                                                                
                    type: 'datetime',
                    title: {                                                            
                        text: '服务器时间'                                                   
                    },                                                    
                    tickPixelInterval: 150                                              
                },                                                                      
                yAxis: {                                                                
                    title: {                                                            
                        text: '平均负载'                                                   
                    },                                                                  
                    plotLines: [{                                                       
                        value: 0,                                                       
                        width: 1,                                                       
                        color: '#808080'                                                
                    }]                                                                  
                },                                                                      
                tooltip: {                                                              
                    formatter: function() {                                             
                            return '<b>'+ this.series.name +'</b><br/>'+                
                            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                            '平均负载'+'：'+Highcharts.numberFormat(this.y, 2);                         
                    }                                                                   
                },                                                                      
                legend: {                                                               
                    enabled: false                                                      
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: false
                        }
                    },
                },                                                                      
                exporting: {                                                            
                    enabled: false                                                      
                },                                                                      
                series: [{                                                              
                    name: '处理器平均负载',                                                
                    data: (function() {                                                 
                        // generate an array of random data                             
                        var data = [],                                                  
                            time = (new Date()).getTime(),                              
                            i;                                                          
                                                                                        
                        for (i = -19; i <= 0; i++) {                                    
                            data.push({                                                 
                                x: time + i * 1000,                                     
                                y: 0                                        
                            });                                                         
                        }                                                               
                        return data;                                                    
                    })()                                                                
                }]                                                                      
            });                                                                         
        });                                                                                                                                                              
    });   

    $(function () {                                                                     
        $(document).ready(function() {                                                  
            Highcharts.setOptions({                                                     
                global: {                                                               
                    useUTC: false                                                       
                }                                                                       
            });                                                                         
                                                                                        
            var chart;                                                                  
            $('#ServerMemoryUsed').highcharts({                                                
                chart: {                                                                
                    type: 'spline',                                                     
                    animation: Highcharts.svg,           
                    marginRight: 10,                                                    
                    events: {                                                           
                        load: function() {    
                            var series = this.series[0]; 
                             var x,y;                          
                            setInterval(function() {    
                            $.ajax({
                                type:'GET',
                                url:'?act=mem',//请求数据的地址
                                success:function(data){    
                                    tmp = parseFloat(data);
                                    x = (new Date()).getTime(),y = tmp;                                  
                                    series.addPoint([x, y], true, true);       
                                }
                            });                                
                                             
                            }, 2000);                                                   
                        }                                                               
                    }                                                                   
                },                                                                      
                title: {                                                                
                    text: '服务器内存使用率'                                            
                },                                                                      
                xAxis: {                                                                
                    type: 'datetime',  
                    title: {                                                            
                        text: '服务器时间'                                                   
                    },                                                 
                    tickPixelInterval: 100                                              
                },                                                                      
                yAxis: {                                                                
                    title: {                                                            
                        text: '内存'                                                   
                    },                                                                  
                    plotLines: [{                                                       
                        value: 0,                                                       
                        width: 1,                                                       
                        color: '#808080'                                                
                    }] ,
                    labels: {
                    formatter: function () {
                        return this.value + 'GB';
                    }
                }                                                                  
                },                                                                      
                tooltip: {                                                              
                    formatter: function() {                                             
                            return '<b>'+ this.series.name +'</b><br/>'+                
                            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                            "内存占用："+Highcharts.numberFormat(this.y, 2)+" GB";                         
                    }                                                                   
                },                                                              
                legend: {                                                               
                    enabled: false                                                      
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: false
                        }
                    },
                },                                                                  
                exporting: {                                                            
                    enabled: false                                                      
                },                                                                      
                series: [{                                                              
                    name: '内存占用',                                               
                    data: (function() {                                                                           
                        var data = [],                                                  
                            time = (new Date()).getTime(),                              
                            i;                                                          
                                                                                        
                        for (i = -19; i <= 0; i++) {                                    
                            data.push({                                                 
                                x: time + i * 1000,                                     
                                y: 0                                        
                            });                                                         
                        }                                                               
                        return data;                                                    
                    })()                                                                
                }]                                                                      
            });                                                                         
        });                                                                                                                                                              
    });  

    $(function () {
        var disktotle,diskfree,diskused = 0;
        var options = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: '比例',
            }]
        };
        $('#ServerDiskUsed').highcharts(options);
        $.ajax({
            type:'GET',
            url:'?act=chart',//请求数据的地址
            success:function(data){
                var json = eval("("+data+")")      
                disktotle = json.disktotal;
                diskfree = json.diskfree;
                diskused = disktotle - diskfree;
                options.series[0].data = new Array([diskused+"GB"+' 已用',   diskused],[diskfree+"GB"+' 空闲',   diskfree]); 
                $('#ServerDiskUsed').highcharts(options);
            }
        });
    });*/

var Weburl = getRootPath();
/*
    $(".deletePage").click(function(){
        $(this).addClass("deletePage btn btn-danger btn-xs disabled");
        var id = $(this).val();
        var a = $(this);
        $.ajax({
            type:'POST',
            data: {id:id},
            url:Weburl+'/admin/controller.php?action=delectPage',//请求数据的地址
            success:function(data){
                a.removeClass();
                a.addClass("deletePage btn btn-success btn-xs disabled");
                a.html("成功");
                TwoSecRefresh();
            }
        });
    });

    $(".deleteReply").click(function(){
        $(this).addClass("deleteReply btn btn-danger btn-xs disabled");
        var id = $(this).val();
        var a = $(this);
        $.ajax({
            type:'POST',
            data: {id:id},
            url:Weburl+'/admin/controller.php?action=deleteReply',//请求数据的地址
            success:function(data){
                a.removeClass();
                a.addClass("deleteReply btn btn-success btn-xs disabled");
                a.html("成功");
                TwoSecRefresh();
            }
        });
    });
*/
    $(".sega").click(function(){
        $(this).addClass("sega btn btn-danger btn-xs disabled");
        var id = $(this).val();
        var a = $(this);
        $.ajax({
            type:'POST',
            data: {id:id},
            url:Weburl+'/admin/controller.php?action=sega',//请求数据的地址
            success:function(data){
                a.removeClass();
                a.addClass("sega btn btn-success btn-xs disabled");
                a.html("成功");
                TwoSecRefresh();
            }
        });
    });

    $(".nobo").click(function(){
        $(this).addClass("nobo btn btn-danger btn-xs disabled");
        var id = $(this).val();
        var a = $(this);
        $.ajax({
            type:'POST',
            data: {id:id},
            url:Weburl+'/admin/controller.php?action=nobo',//请求数据的地址
            success:function(data){
                a.removeClass();
                a.addClass("nobo btn btn-success btn-xs disabled");
                a.html("成功");
                TwoSecRefresh();
            }
        });
    });

    

    $('.deletePage').click(function (){
        var id = $(this).val();
        $('#myModal').on('show.bs.modal', function () {
            $('.modal-body').text("确定要删除帖子No."+id+"吗？");
            $('.alert').addClass('alert alert-danger');
            $('.alert').find('strong').text("警告！");
            $('.alert').find('span').text("删除后不可恢复！");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {id:id},
                    url:Weburl+'/admin/controller.php?action=delectPage',//请求数据的地址
                    success:function(data){
                        $('.alert').removeClass().addClass('alert alert-success');
                        $('.alert').find('strong').text("成功！");
                        $('.alert').find('span').text("两秒后刷新页面");
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });

    $('.deleteReply').click(function (){
        var id = $(this).val();
        $('#myModal').on('show.bs.modal', function () {
            $('.modal-body').text("确定要删除该回复吗？");
            $('.alert').addClass('alert alert-danger');
            $('.alert').find('strong').text("警告！");
            $('.alert').find('span').text("删除后不可恢复！");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {id:id},
                    url:Weburl+'/admin/controller.php?action=deleteReply',//请求数据的地址
                    success:function(data){
                        $('.alert').removeClass().addClass('alert alert-success');
                        $('.alert').find('strong').text("成功！");
                        $('.alert').find('span').text("两秒后刷新页面");
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });
    $('.replycheckbox').click(function (){
        $('#myModal').on('show.bs.modal', function () {
            var count = 0;
            var Arr=new Array()
            $('input[type="checkbox"][name="replycheckbox"]:checked').each(
                function() {
                    Arr[count] = $(this).val();
                    count++;
                }
            );
            $('.modal-body').text("确定要删除所选回复吗？");
            $('.alert').addClass('alert alert-danger');
            $('.alert').find('strong').text("警告！");
            $('.alert').find('span').text("删除后不可恢复！");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {Arr:Arr},
                    url:Weburl+'/admin/controller.php?action=replycheckbox',//请求数据的地址
                    success:function(data){
                        console.log(data);
                        $('.alert').removeClass().addClass('alert alert-success');
                        $('.alert').find('strong').text("成功！");
                        $('.alert').find('span').text("两秒后刷新页面");
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });
    $('.pagecheckbox').click(function (){
        $('#myModal').on('show.bs.modal', function () {
            var count = 0;
            var Arr=new Array()
            $('input[type="checkbox"][name="pagecheckbox"]:checked').each(
                function() {
                    Arr[count] = $(this).val();
                    count++;
                }
            );
            $('.modal-body').text("确定要删除所选回复吗？");
            $('.alert').addClass('alert alert-danger');
            $('.alert').find('strong').text("警告！");
            $('.alert').find('span').text("删除后不可恢复！");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {Arr:Arr},
                    url:Weburl+'/admin/controller.php?action=pagecheckbox',//请求数据的地址
                    success:function(data){
                        console.log(data);
                        $('.alert').removeClass().addClass('alert alert-success');
                        $('.alert').find('strong').text("成功！");
                        $('.alert').find('span').text("两秒后刷新页面");
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });

    $('.fatherblock').click(function (){
        $('.fatherblockText').val($(this).attr("value"));
    });

    $('.changefatherblock').click(function (){
        $('.fatherblocklogoText').val($(this).attr("value"));
    });

    $('.createblock').click(function (){
        var block = $(this).val();
        var father = $('.fatherblockText').val();
        var son = $('.sonblockText').val();
        $('#myModal').on('show.bs.modal', function () {
            $('.modal-body').text("父版块为： "+father+" 子版块为:"+son);
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {father:father,son:son},
                    url:Weburl+'/admin/controller.php?action=createblock',//请求数据的地址
                    success:function(data){
                        console.log(data);
                        var decode = JSON.parse(data);
                        switch(decode.errorcode){
                            case "1":
                                $('.alert').addClass('alert alert-danger');
                                $('.alert').find('strong').text("失败！");
                                $('.alert').find('span').text("父、子版块名称不能为空！");
                                break;
                            case "2":
                                $('.alert').addClass('alert alert-danger');
                                $('.alert').find('strong').text("失败！");
                                $('.alert').find('span').text("已存在该子版块");
                                break;
                            case "0":
                                $('.alert').addClass('alert alert-success');
                                $('.alert').find('strong').text("成功！");
                                $('.alert').find('span').text("两秒后刷新页面");
                                break;
                        }
                        
                        
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });
    $('.delectblock').click(function (){
        var block = $(this).val();
        $('#myModal').on('show.bs.modal', function () {
            $('.modal-body').text("确定要删除 '"+block+"' 吗？");
            $('.alert').addClass('alert alert-danger');
            $('.alert').find('strong').text("警告！");
            $('.alert').find('span').text("删除后不可恢复！");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {block:block},
                    url:Weburl+'/admin/controller.php?action=delectblock',//请求数据的地址
                    success:function(data){
                        $('.alert').removeClass().addClass('alert alert-success');
                        $('.alert').find('strong').text("成功！");
                        $('.alert').find('span').text("两秒后刷新页面");
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });
    $('.changefatherblocklogo').click(function (){
        var father = $('.fatherblocklogoText').val();
        var logo = $('.fatherblocklogo').val();
        $('#myModal').on('show.bs.modal', function () {
            $('.modal-body').html("父版块为： "+father+" 图标修改为：<i class='"+logo+"'></i>");
            $('#yes').click(function (){
                $(this).addClass("disabled");
                $.ajax({
                    type:'POST',
                    data: {father:father,logo:logo},
                    url:Weburl+'/admin/controller.php?action=changefatherblocklogo',//请求数据的地址
                    success:function(data){
                        console.log(data);
                        var decode = JSON.parse(data);
                        switch(decode.errorcode){
                            case "1":
                                $('.alert').addClass('alert alert-danger');
                                $('.alert').find('strong').text("失败！");
                                $('.alert').find('span').text("无此父版块！");
                                break;
                            case "0":
                                $('.alert').addClass('alert alert-success');
                                $('.alert').find('strong').text("成功！");
                                $('.alert').find('span').text("两秒后刷新页面");
                                break;
                        }
                        
                        
                        TwoSecRefresh();
                    }
                });
            });   
        })
    });

    $(".blocknav").pin();
});

function getRootPath() {
    var pathName = window.location.pathname.substring(1);
    var webName = pathName == '' ? '' : pathName.substring(0, pathName.indexOf('/'));
    //return window.location.protocol + '//' + window.location.host + '/'+ webName + '/';
    return window.location.protocol + '//' + window.location.host + '/'+ webName;
} 

function TwoSecRefresh(){
    setTimeout(function () {
        window.location.reload();
    }, 2000);
}