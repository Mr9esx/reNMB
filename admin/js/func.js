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
    $('.createblock').click(function (){
        var father = $('.fatherblockText').val();
        var son = $('.sonblockText').val();
        var logo = $('.sonblockLogo').val();
        $.ajax({
            type:'POST',
            data: {father:father,son:son,logo:logo},
            url:Weburl+'/admin/controller.php?action=createblock',//请求数据的地址
            success:function(data){
                console.log(data);
                
                TwoSecRefresh();
            }
        });
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