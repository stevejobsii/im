<?php

namespace App\Http\Controllers\Mall;

use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class IndexController extends Controller
{
    public function oauth()
    {
        $app = app('wechat');
        return $response = $app->oauth->scopes(['snsapi_userinfo'])->redirect()->to('mall');
        // session('wechat.oauth_user');
        // return redirect()->to('mall');
    }

    public function index()
    {
        Log::info('request(callback) arrived.'); 
        $app_env = env('APP_ENV');
        if($app_env != 'beta'){
            $wechat = app('wechat');
            $js = $wechat->js;
        }else{
            $js = FALSE;
        }
        return view('mall.index')->with(['js'=>$js]);
    }
}
