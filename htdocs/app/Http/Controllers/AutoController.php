<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2016/4/25
 * Time: 17:34
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Auto;
use App\Attr;

class AutoController extends BaseController
{

    public function getList()
    {
        $autos = Auto::distinct()->where('id', '!=', '0')->get(['id']);
        $arr = array();
        foreach($autos as $auto)
        {
            $attr = Attr::where('id', $auto->id)->get();
            if(sizeof($attr) != 0)
            {
                $item['name'] = $attr[0]->alias;
            }
            else
            {
                $item['name'] = '未指定';
            }
            $item['id'] = $auto->id;
            $arr[] = $item;
        }
        return json_encode($arr);
    }

    public function getData(Request $request)
    {
        $number = $request->input('number');
        $attr = Attr::where('id', $number)->get();
        if(sizeof($attr) == 0)
        {
            return "null";
        }

        $init = $attr[0]->init;
        $r = $attr[0]->r;
        $arr = array();
        $datas = Auto::where('id', $number)->get();
        if(count($datas) == 0) {
            return "null";
        }

        $start_time = strtotime("2016-5-1 0:0:0");
        foreach($datas as $data)
        {
            //日期比较，只使用5月份的数据
            if(strtotime($data->time) < $start_time)
            {
                continue;
            }
//            $arr['time'][] = $data->time;
            $a = ($data->measure * $data->measure - $init * $init) * $r;
            if($a > 0)
            {
                $measure = $a * $attr[0]->K_negetive;
            }
            else
            {
                $measure = $a * $attr[0]->K_positive;
            }
            $arr[] = [
                'time' => $data->time,
                'measure' => $measure,
            ];

        }
        return json_encode($arr);
    }
}
