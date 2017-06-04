<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Input;
//use Flash;

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
            //dd($oauthUser);
            if ($user = User::where('wechat_openid', '=', $oauthUser->id)->first()){
                Auth::login($user,true);
                return redirect('/'); 
            }else{
                dd($oauthUser);
                return redirect('/login'); 
            }
        }
    }
}
