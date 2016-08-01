/**
 * Created by Weapon on 2016/4/28.
 */
function realTimeRefrash(sensorType) {
    apptimeTicket = setInterval(function () {
        // 获取实时更新数据
        var array;
        if(sensorType == "auto"){
            array = auto_LegendArray;
        }
        else if(sensorType == "manual"){
            array = manual_LegendArray;
        }
        else{
            alert("传感器类型不存在！");
            return;
        }

        for (var x = 0; x < array.length; x++) {
            $.ajax({
                type: "GET",
                url: sensorType+"/data?number=" + array[x],
                async: false, //必须同步
                success: function (data) {
                    var seriesArray = [];
                    if(data == "null"){
                        alert("测试数据为空");
                        return;
                    }
                    else{
                        data = JSON.parse(data);//强制转换为json对象
                        //按照时间排序
                        data.sort( function(a, b){
                            var aTime = new Date(a["time"]);
                            var bTime = new Date(b["time"]);
                            return aTime > bTime ? 1 : aTime == bTime ? 0 : -1;
                        });

                        //添加到seriesArray中
                        for(var y = 0;y < data.length;y++) {
                            var seriesItem = [];
                            seriesItem.push(new Date(data[y]["time"]).getTime());
                            seriesItem.push(data[y]["measure"]);
                            seriesArray.push(seriesItem);
                        }

                        if(sensorType == "auto"){
                            var min = auto_Option.xAxis[0].min;
                            var max = auto_Option.xAxis[0].max;
                            if(new Date(data[0]["time"]).getTime() < min){
                                auto_MyChart.setOption({
                                    xAxis: [{
                                        min: new Date(data[0]["time"]).getTime()
                                    }]
                                });
                            }
                            if(new Date(data[data.length-1]["time"]).getTime() > max){
                                auto_MyChart.setOption({
                                    xAxis: [{
                                        max: new Date(data[data.length-1]["time"]).getTime()
                                    }]
                                });
                            }
                            auto_MyChart.setOption({
                                series: [{
                                    name: array[x],
                                    data: seriesArray
                                }]
                            });
                        }
                        else if(sensorType == "manual"){
                            var min = manual_Option.xAxis[0].min;
                            var max = manual_Option.xAxis[0].max;
                            if(new Date(data[0]["time"]).getTime() < min){
                                manual_MyChart.setOption({
                                    xAxis: [{
                                        min: new Date(data[0]["time"]).getTime()
                                    }]
                                });
                            }
                            if(new Date(data[data.length-1]["time"]).getTime() > max){
                                manual_MyChart.setOption({
                                    xAxis: [{
                                        max: new Date(data[data.length-1]["time"]).getTime()
                                    }]
                                });
                            }
                            manual_MyChart.setOption({
                                series: [{
                                    name: array[x],
                                    data: seriesArray
                                }]
                            });
                        }
                    }
                },
                error: function (msg) {
                    alert("数据加载失败！");
                }
            });;
        }
    }, 5000);
}