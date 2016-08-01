<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>数据录入</title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>

    <style>
        label {width:72px;}
    </style>

    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script type="application/javascript">
        function form_submit() {
            var result = new Array();

            var ids = $("input[id='id']");
            var measures = $("input[id='measure']");

            var n = ids.length;
            for (var i = 0; i < n; i++)
            {
                result[i] = {
                    id      :   ids[i].value,
                    measure :   measures[i].value
                }
            }

            $.post('insert',
                    {
                        data:JSON.stringify(result),
                        time:$("#time")[0].value
                    },
                    function(data, status) {
                        if (data == 'success') {
                            alert("添加成功，点击确定继续添加");
                            location.reload();
                        }
                        else {
                            alert("出现未知错误，请稍后重试");
                        }
                    });
        }
    </script>
</head>
<body>

<?php
date_default_timezone_set('PRC');
?>
<div class="container">
    <h1 class="text-center">数据录入</h1>
    <br /><br/>
    <div class="col-sm-12">
    <form id="form" class="form-inline" method="post">

        <div class="col-sm-12">
            <div class="form-group">
                <label for="time">时间：</label>
                <input class="form-control" type="datetime" id="time" name="time" value="{{date("Y-n-j G:i:s")}}" disabled="disabled">
            </div>
        </div>

        <br /><br /><br />

        @foreach($ids as $id)
        <div class="col-sm-2">
        <div class="form-group">
            <label for="id">编号：</label>
            <input class="form-control" type="number" id="id" value="{{$id->input_id}}" name="id" disabled="disabled">
        </div>

        <div class="form-group">
            <label for="measure">监测值：</label>
            <input class="form-control" type="number" id="measure" name="measure">
        </div>
        </div>
        @endforeach

        <br /><br /><br /><br /><br /><br /><br /><br />

        <div class="col-sm-12">
            <input class="btn btn-primary btn-block" type="button" onclick="form_submit()" value="添加数据">
        </div>
    </form>
    </div>
    <script type="application/javascript">
        $("#measure")[0].focus();
    </script>
</div>

</body>
</html>