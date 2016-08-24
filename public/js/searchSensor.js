/**
 * Created by Weapon on 2016/7/30.
 */
function searchSensor(sensorType){
    //download script
    var field = jQuery("#field").val().trim();
    if(field == ""){
        alert("查询条件为空");
        return;
    }
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
                
                //清空传感器下的所有子节点
                var div = document.getElementById("table");
                while(div.hasChildNodes()) {
                    div.removeChild(div.firstChild);
                }
                for(var x = 0;x < data.length;x++){
                    if(data[x].name.indexOf(field) != -1){
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
                            "loadEChartsData('" + input.id + "','" + input.value + "','" + data[x].name +"','"+sensorType+"');");
                    }
                }
            }
        },
        error: function (msg) {
            alert("传感器数据加载失败");
        }
    });
}