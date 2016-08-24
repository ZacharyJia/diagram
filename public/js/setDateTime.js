/**
 * Created by Weapon on 2016/7/31.
 */
function setDateTime(sensorType) {
    var begin = jQuery("#beginTime").val();
    var end = jQuery("#endTime").val();
    // alert(beginTime +"    "+endTime);
    if(begin == "" || begin == null || end == "" || end == null){
        alert("选择的日期为空");
        return;
    }
    var beginTime = new Date(Date.parse(begin.replace(/-/g,   "/")));
    var endTime = new Date(Date.parse(end.replace(/-/g,   "/")));

    // alert(timeFormatter(beginTime) +"    "+timeFormatter(endTime));
    if(beginTime >= endTime){
        alert("日期范围不合法");
        return;
    }
    if(sensorType == 'manual'){
        manual_Option.xAxis[0].min = beginTime.getTime();
        // alert(beginTime.getTime());
        manual_Option.xAxis[0].max = endTime.getTime();
        // alert(endTime.getTime());
        manual_MyChart.setOption(manual_Option,true);
        //manual_MyChart.hideLoading();
    }
    else if(sensorType == 'auto'){
        auto_Option.xAxis[0].min = beginTime.getTime();
        auto_Option.xAxis[0].max = endTime.getTime();
        auto_MyChart.setOption(auto_Option,true);
        //auto_MyChart.hideLoading();
    }
    else {
        alert("传入的传感器参数出错");
    }
}