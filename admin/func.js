$(document).ready(function(){
	getJSONData();

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
/*$(function () {
   	var memOption = {
        chart: {
            type: 'area'
        },
        title: {
            text: '服务器内存使用率'
        },
        subtitle: {
            text: '内存'
        },
        xAxis: {
            allowDecimals: false,
            title: {
                text: '服务器当前时间'
            },
            labels: {
                formatter: function () {
                    return time[0]; // clean, unformatted number for year
                }
            }
        },
        yAxis: {
            title: {
                text: '内存'
            },
            labels: {
                formatter: function () {
                    return this.value + 'GB';
                }
            }
        },
        plotOptions: {
            area: {
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 3,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: '内存占用',
        }]
    };
    $('#ServerMemoryUsed').highcharts(memOption);
	var arr = new Array();
	var Time = setInterval(function(){
		$.ajax({
	        type:'GET',
	        url:'?act=mem',//请求数据的地址
	        success:function(data){    
	           	// alert(json);
	           	arr.unshift(parseFloat(data));
	           	if(arr.length > 7){
					arr.pop();
				}
				memOption.series[0].data = arr;
	           	console.log(arr);
	        }
	    });
	},200);
	
});*/


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
        
  

});



/*setInterval(function() {
	$.ajax({
        type:'get',
        url:'?act=chart',//请求数据的地址
        success:function(data){
            var json = eval("("+data+")");
           	a.series.setData = json.UsedMemory;
        }
    });}, 1000);
*/

});
function getJSONData(){
	setTimeout("getJSONData()", 1000);
	$.getJSON('?act=rt&callback=?', displayData);
}

function displayData(dataJSON){
	$("#freeSpace").html(dataJSON.freeSpace);
	$("#TotalMemory").html(dataJSON.TotalMemory);
	$("#UsedMemory").html(dataJSON.UsedMemory);
	$("#FreeMemory").html(dataJSON.FreeMemory);
	$("#CachedMemory").html(dataJSON.CachedMemory);
	$("#Buffers").html(dataJSON.Buffers);
	$("#TotalSwap").html(dataJSON.TotalSwap);
	$("#swapUsed").html(dataJSON.swapUsed);
	$("#swapFree").html(dataJSON.swapFree);
	$("#swapPercent").html(dataJSON.swapPercent);
	$("#loadAvg").html(dataJSON.loadAvg);
	$("#uptime").html(dataJSON.uptime);
	$("#freetime").html(dataJSON.freetime);
	$("#stime").html(dataJSON.stime);
	$("#bjtime").html(dataJSON.bjtime);
	$("#memRealUsed").html(dataJSON.memRealUsed);
	$("#memRealFree").html(dataJSON.memRealFree);
	$("#memRealPercent").html(dataJSON.memRealPercent);
	$("#memPercent").html(dataJSON.memPercent);
	$("#barmemPercent").width(dataJSON.memPercent);
	$("#barmemRealPercent").width(dataJSON.barmemRealPercent);
	$("#memCachedPercent").html(dataJSON.memCachedPercent);
	$("#barmemCachedPercent").width(dataJSON.barmemCachedPercent);
	$("#barswapPercent").width(dataJSON.barswapPercent);
	$("#NetOut2").html(dataJSON.NetOut2);
	$("#NetOut3").html(dataJSON.NetOut3);
	$("#NetOut4").html(dataJSON.NetOut4);
	$("#NetOut5").html(dataJSON.NetOut5);
	$("#NetOut6").html(dataJSON.NetOut6);
	$("#NetOut7").html(dataJSON.NetOut7);
	$("#NetOut8").html(dataJSON.NetOut8);
	$("#NetOut9").html(dataJSON.NetOut9);
	$("#NetOut10").html(dataJSON.NetOut10);
	$("#NetInput2").html(dataJSON.NetInput2);
	$("#NetInput3").html(dataJSON.NetInput3);
	$("#NetInput4").html(dataJSON.NetInput4);
	$("#NetInput5").html(dataJSON.NetInput5);
	$("#NetInput6").html(dataJSON.NetInput6);
	$("#NetInput7").html(dataJSON.NetInput7);
	$("#NetInput8").html(dataJSON.NetInput8);
	$("#NetInput9").html(dataJSON.NetInput9);
	$("#NetInput10").html(dataJSON.NetInput10);	
}