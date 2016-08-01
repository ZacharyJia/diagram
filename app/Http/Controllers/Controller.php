<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Auto;

class Controller extends BaseController
{
    //
    public function hello()
    {
        return view('welcome')->with("msg", "hello");
    }
}
