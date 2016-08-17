<?php
/**
 * Created by PhpStorm.
 * User: zachary
 * Date: 16/8/3
 * Time: 下午10:19
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
//        dd($_SESSION['isLogin']);
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            return $next($request);
        }
        else {
            return redirect('/login?next=' . $request->getUri());
        }
    }

}