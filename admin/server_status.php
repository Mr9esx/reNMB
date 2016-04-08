<?php
	if(isset($_GET['action'])){
		require_once ('func.php');
	}else{
		exit();
	}

?>
<script type="text/javascript">
	
    $(function () {                                                                     
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
                                url:'func.php?type=cpu',//请求数据的地址
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
                                url:'func.php?act=mem',//请求数据的地址
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
            url:'func.php?act=chart',//请求数据的地址
            success:function(data){ 
                var item = eval('('+data+')');
               	disktotle = item.disktotal;
                diskfree = item.diskfree;
                diskused = disktotle - diskfree;                          
                options.series[0].data = new Array([diskused+"GB"+' 已用',   diskused],[diskfree+"GB"+' 空闲',   diskfree]); 
                $('#ServerDiskUsed').highcharts(options);
            }
        });
    });
</script>

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