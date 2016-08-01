function loadSensor(sensorType) {
    // alert(sensorType);
    $.ajax({
        type: "GET",
        url: sensorType+"/list",
        success: function (data) {
            //强制转换为json对象
            if(data == "null"){
                alert("传感器数据为空");
                return;
            }
            else{
                data = JSON.parse(data);
                //根据name进行排序
                data.sort( function(a, b){
                    return a["name"] > b["name"] ? 1 : a["name"] == b["name"] ? 0 : -1;
                });
                for(var x = 0;x < data.length;x++){
                    var row = document.createElement("tr");
                    var input = document.createElement('input');
                    var span = document.createElement('span');
                    input.id = 'sensor' + x;//复选框id
                    input.type = 'checkbox';//输入框类型
                    input.value = data[x].id; //复选框值
                    row.appendChild(input);
                    span.innerHTML = "&nbsp;&nbsp;" + data[x].name + '<br><br>';
                    row.appendChild(span);
                    document.getElementById("table").appendChild(row);
                    //添加onclick事件
                    $("#" + input.id).attr("onclick",
                        "loadEChartsData('" + input.id + "','" + input.value + "','"+sensorType+"');");
                }
            }
        },
        error: function (msg) {
            alert("传感器数据加载失败");
        }
    });
}

