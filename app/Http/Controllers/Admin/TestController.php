<?php
/**
 * Created by Phpstorm
 * Class TestContorller
 * Author Depp
 * Date: 2020/10/12 14:43
 * Description:
 */


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


class TestController extends Controller
{
    /**
     * 角色管理首页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("text");
        $url="https://v.douyin.com/Jf1h6fk/";
        dd(VideoManager::DouYin()->start($url));

    }

    public function testRedis(){
        $a = Redis::set("aaa",'dsdada');
        dd($a);
    }


}
