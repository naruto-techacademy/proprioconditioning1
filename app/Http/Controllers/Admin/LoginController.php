<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Admin\Auth;   // 追加
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';
    
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // 管理者ログイン画面
    public function showLoginForm()
    {
        return view('admin/login'); //https://coinbaby8.com/laravel-multi-login.html
    }

    protected function guard()
    {
        return \Auth::guard('admin'); //管理者認証のguardを指定
    }

    /**
    * Log the user out of the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    
    
    
    public function logout(Request $request) //https://coinbaby8.com/laravel-multi-login.html参考
    {
    //    Auth::guard('admin')->logout();
        $this->guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        
        return redirect('/admin/login');  // ログアウト後のリダイレクト先
    }
   
    //public function logout()
	//	{		
	//		$this->guard('admin')->logout();	
		   // $this->middleware('guest')->except('logout');
	//	}
}
