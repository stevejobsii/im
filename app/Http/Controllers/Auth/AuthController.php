<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    // 不允许自由注册
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    // }

    //接入oauth   
    public function oauth(Request $request) { 
        $driver = $request->query('driver'); 
        
        if (Auth::check())
         //&& Auth::user()->wechat_openid) 
        {
            return redirect('/');
        }

        // if ($driver == 'qq') {
        // return \Socialite::with('qq')->redirect();}
        if ($driver == 'weixin') {
        return \Socialite::with('weixin')->redirect();}
    }

    //callback
    public function callback($provider) {
        //return 'sff';
        //要是有回code参数
        if (Input::has('code')) {
            //return 'sff';
            $oauthUser = \Socialite::with($provider)->user();
            //判断登录的用户能否找到
            //return json_encode($oauthUser);
            $user = User::getByDriver($provider, $oauthUser->id);

            if (Auth::check()) {
            //要是正在用户状态，判断能否绑定,未测试
                if ($user && $user->id != Auth::id()) {
                    Flash::error(lang('Sorry, this socialite account has been registed.', ['driver' => lang($provider)]));
                } else {//绑定
                    $this->bindSocialiteUser($oauthUser, $provider);
                    Flash::success(lang('Bind Successfully!', ['driver' => lang($provider)]));
                }
                return redirect(route('users.edit_social_binding', Auth::id()));
            } else {
            //要是非登录状态
                if ($user) {//登录的用户能找到，登录
                    return $this->loginUser($user);
                }
                //登录的用户不能找到，注册
                return $this->userNotFound($provider, $oauthUser);
            }
        }
    }


    //绑定
    public function bindSocialiteUser($oauthUser, $provider)
    {
        $currentUser = Auth::user();

        if ($provider == 'qq') {
            $currentUser->qq_id = $oauthUser->id;
           //$currentUser->github_url = $oauthUser->user['url'];
        } elseif ($provider == 'weixin') {
            $currentUser->wechat_openid = $oauthUser->id;
            $currentUser->wechat_unionid = $oauthUser->user['unionid'];
        }

        $currentUser->save();
    }

}
