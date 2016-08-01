<!DOCTYPE html>
<html>
<head>
    <title>框构桥受力监测系统</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <link rel="stylesheet" type="text/css" href="css/DateTimePicker.css">
</head>
<body>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/echarts.min.js"></script>
<script src="js/loadECharts.js"></script>
<script src="js/searchSensor.js"></script>
<script src="js/loadSensor.js" onload="loadSensor('auto')"></script>
<script src="js/timeFormatter.js"></script>
<script src="js/setDateTime.js"></script>
<script src="js/dataRefrash.js" onload="realTimeRefrash('auto')"></script>
<script type="text/javascript" src="js/DateTimePicker.js"></script>
<!-- For i18n Support -->
<!-- <script type="text/javascript" src="js/DateTimePicker-i18n.js"></script> -->

<header class="list-header">
    <h1>框构桥受力监测系统</h1>
    <nav>
        <a href="manual">手动</a>
        <a href="auto" class="active">自动</a>
    </nav>
</header>

<div class="wrapper">
    <section id='steezy' style="margin-right: auto;margin-left: auto">
        <div class="htmleaf-left">
            <div style="margin:0 auto; top: 0px;width:250px; height:50px; background:#fff;">
                <h2 style="text-align:center; margin-top:20px;"></h2>
                <div class="style_1">
                    <div id="searchform">
                        <fieldset>
                            <input id="field" name="field" type="text" class="text_input"/>
                            <input id="search" name="search" type="submit" value="" onclick="searchSensor('auto')"/>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div id="Sensor">
                <table width="70%" style="margin: 0 auto">
                    <tbody id="table">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="htmleaf-right">
            <table style="margin:0 auto; top: 10px;">
                <tr>
                    <td>
                        <h2 style="text-align:center; margin-top:20px;"></h2>
                        <span style="font-size: 20px">时间范围：&nbsp;&nbsp;</span>
                    </td>
                    <td>
                        <h2 style="text-align:center; margin-top:20px;"></h2>
                        <input type="text" id="beginTime" class="dateInput" data-field="datetime" readonly>
                    </td>
                    <td>
                        <h2 style="text-align:center; margin-top:20px;"></h2>
                        <span style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;到&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td>
                        <h2 style="text-align:center; margin-top:20px;"></h2>
                        <input type="text" id="endTime" class="dateInput" data-field="datetime" readonly>
                    </td>
                    <td>
                        <h2 style="text-align:center; margin-top:10px;"></h2>
                        <div id="setDateTime">
                            <input type="submit" value="设置" onclick="setDateTime('auto')"/>
                        </div>
                    </td>
                </tr>
            </table>
            <div id="dtBox"></div>
            <script>
                $(document).ready(function() {
                    $("#dtBox").DateTimePicker();
                });
            </script>
            <div id="main" style="width:80%;height:650px;margin: 0 auto;top: 20px">
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    var auto_LegendArray = []; //数组：存放显示传感器类型

    var auto_MyChart = echarts.init(document.getElementById('main'));
    auto_MyChart.showLoading();
    var auto_Option = {
        title: {
            text: '传感器测试数据'
        },
        toolbox: {
            show : true,
            orient : 'vertical',
            right: 0,
            top: 'center',
            itemSize: 30,
            feature: {
                saveAsImage: {
                    title:"保存图片"
                }
            }
        },
        tooltip: {
            trigger: 'axis',
            borderRadius: 8,
            formatter: function (params, ticket, callback) {
                var result = "";
                for (var i = 0; i < params.length; i++) {
                    var str = (params[i].data.toString()).split(",");
                    var formatterTime = timeFormatter(new Date(parseInt(str[0])));
                    result += params[i].seriesName + ": " + formatterTime + ", " + str[1] + "<br>";
                }
                return result;
            }
        },
        legend: {
            left: 'center',
            data: auto_LegendArray
        },
        calculable: true,
        grid: {
            x: 50,
            x2: 50
        },
        dataZoom: [
            {
                type: 'slider',
                show: true,
                xAxisIndex: [0],
                start: 0,
                end: 100
            },
            {
                type: 'inside',
                xAxisIndex: [0],
                start: 0,
                end: 100
            },
        ],
        xAxis: [
            {
                type: 'time',
                axisLabel: {
                    formatter: function (value) {
                        return timeFormatter(new Date(value));
                    }
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            }
        ],
        series: [],
        animation: false
    };
    auto_MyChart.hideLoading();
    auto_MyChart.setOption(auto_Option);// 为echarts对象加载数据
</script>

<!--下拉动画-->
<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
<script>
    $(function () {
        $(window).scroll(function () {
            var winTop = $(window).scrollTop();
            if (winTop >= 30) {
                $('body').addClass('sticky-header');
            } else {
                $('body').removeClass('sticky-header');
            }
        });
    });
    window.onresize = function(){
        auto_MyChart.resize();
    }
</script>
</body>
</html>
