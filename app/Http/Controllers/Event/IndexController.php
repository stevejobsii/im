<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class IndexController extends Controller
{
    public function oauth()
    {
        //Log::info('request(index.user.callback) arrived.'); 
        session('wechat.oauth_user');
        return redirect()->to('event');
    }

    public function index()
    {
        //Log::info('request(index.callback) arrived.'); 
        $app_env = env('APP_ENV');
        if($app_env != 'beta'){
            $wechat = app('wechat');
            $js = $wechat->js;
        }else{
            $js = FALSE;
        }
        return view('event.index')->with(['js'=>$js]);
    }
}
