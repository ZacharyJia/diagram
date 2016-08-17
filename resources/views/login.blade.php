<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="css/loginStyles.css">
    <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <h1>欢迎登录</h1>
        @if($msg)
            <div style="color: red;">{{$msg}}</div>
        @endif

        <form class="form" id="loginForm" action="doLogin" method="post">
            <input type="hidden" name="next" value="{{ $next }}">
            <input type="text" id="username" name="username" placeholder="用户名" maxlength="16" required>
            <input type="password" id="password" name="password" placeholder="密码" maxlength="16" pattern="(?=^.{4,12}$).*$" title="密码长度至少4位" required >
            <button type="submit" id="login-button">登录</button>
        </form>
    </div>

    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>


<script>
    function validate(){
        event.preventDefault();
        $('form').fadeOut(500);
        $('.wrapper').addClass('form-success');
    }
</script>

</div>
</body>
</html>