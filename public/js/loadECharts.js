/**
 * Created by Weapon on 2016/4/26.
 */
function loadEChartsData(sensorId, sensorValue,sensorType) {
    if ($("#" + sensorId).is(":checked")) {
        $.ajax({
            type: "GET",
            url: sensorType+"/data?number=" + sensorValue,
            async: true,
            success: function (data) {
                var seriesArray = [];
                if(data == "null"){
                    alert("测试数据为空");
                    return;
                }
                else{
                    data = JSON.parse(data);//强制转换为json对象
                    //按时间进行排序
                    data.sort( function(a, b){
                        var aTime = new Date(a["time"]);
                        var bTime = new Date(b["time"]);
                        return aTime > bTime ? 1 : aTime == bTime ? 0 : -1;
                    });
                    // for(var i = 0;i < data.length;i++){
                    //     alert(data[i]["time"]+"   "+data[i]["measure"]);
                    // }

                    //添加到seriesArray中
                    for(var x = 0;x < data.length;x++) {
                        var seriesItem = [];
                        seriesItem.push(new Date(data[x]["time"]).getTime());
                        seriesItem.push(data[x]["measure"]);
                        seriesArray.push(seriesItem);
                    }
                    if(sensorType == "auto"){//自动类型
                        //设置横坐标的起止时间
                        if(auto_Option.xAxis[0].min !=null && auto_Option.xAxis[0].max != null){
                            var min = auto_Option.xAxis[0].min;
                            var max = auto_Option.xAxis[0].max;
                            if(new Date(data[0]["time"]).getTime() < min){
                                auto_Option.xAxis[0].min = new Date(data[0]["time"]).getTime();
                            }
                            if(new Date(data[data.length-1]["time"]).getTime() > max){
                                auto_Option.xAxis[0].max = new Date(data[data.length-1]["time"]).getTime();
                            }
                        }
                        else{//初始化时，没有设置最大最小值
                            auto_Option.xAxis[0].min = new Date(data[0]["time"]).getTime();
                            auto_Option.xAxis[0].max = new Date(data[data.length-1]["time"]).getTime();
                        }
                        auto_LegendArray.push(sensorValue);
                        auto_Option.series.push({
                            smooth: true,
                            name: sensorValue, //与legend一致
                            type: 'line',
                            data:seriesArray
                        });
                        auto_MyChart.setOption(auto_Option, true);
                        auto_MyChart.hideLoading();
                    }
                    else if (sensorType == "manual"){ //手动类型
                        //设置横坐标的起止时间
                        if(manual_Option.xAxis[0].min !=null && manual_Option.xAxis[0].max != null){
                            var min = manual_Option.xAxis[0].min;
                            var max = manual_Option.xAxis[0].max;
                            if(new Date(data[0]["time"]).getTime() < min){
                                manual_Option.xAxis[0].min = new Date(data[0]["time"]).getTime();
                            }
                            if(new Date(data[data.length-1]["time"]).getTime() > max){
                                manual_Option.xAxis[0].max = new Date(data[data.length-1]["time"]).getTime();
                            }
                        }
                        else{//初始化时，没有设置最大最小值
                            manual_Option.xAxis[0].min = new Date(data[0]["time"]).getTime();
                            manual_Option.xAxis[0].max = new Date(data[data.length-1]["time"]).getTime();
                        }
                        manual_LegendArray.push(sensorValue);//压入当前的传感器
                        manual_Option.series.push({
                            smooth: true,
                            name: sensorValue, //与legend一致
                            type: 'line',
                            data:seriesArray
                        });
                        manual_MyChart.setOption(manual_Option,true);
                        manual_MyChart.hideLoading();
                    }
                    else{
                        alert("传入的传感器类型出错");
                    }
                }
            },
            error: function (msg) {
                alert("测试数据加载失败！");
            }
        });
    }
    else {
        //复选框点击取消选中，动态删除数据
        var i = 0;
        if(sensorType == "auto"){
            for (i = 0; i < auto_LegendArray.length; i++) {
                if (auto_LegendArray[i] == sensorValue) break;
            }
            auto_LegendArray.splice(i, 1);
            auto_Option.series.splice(i, 1);

            auto_MyChart.setOption(auto_Option, true);
            auto_MyChart.hideLoading();
        }
        else if (sensorType == "manual"){
            for (i = 0; i < manual_LegendArray.length; i++) {
                if (manual_LegendArray[i] == sensorValue) break;
            }
            manual_LegendArray.splice(i, 1);
            manual_Option.series.splice(i, 1);
            manual_MyChart.setOption(manual_Option,true);
            manual_MyChart.hideLoading();
        }
        else{
            alert("传入的传感器类型出错");
        }
    }
}