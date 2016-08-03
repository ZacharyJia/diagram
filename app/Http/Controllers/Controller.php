<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Auto;


class Controller extends BaseController
{
    //
    public function hello()
    {
        return view('welcome', ['msg' => 'Hello']);
    }

    public function login(Request $request)
    {
        $next = $request->input('next');

        $_SESSION['isLogin'] = true;
        $msg = '';
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            $_SESSION['msg'] = null;
        }
        return view('login', ['msg' => $msg, 'next' => $next]);
    }

    public function doLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $next = $request->input('next');

        if ($username == '' && $password == '') {
            $_SESSION['isLogin'] = true;
        } else {
            $_SESSION['msg'] = "用户名或密码错误,请重新登录";
            return redirect('/login');
        }

        if (!empty($next)) {
            return redirect($next);
        } else {
            return redirect('/manual');
        }
    }
}
