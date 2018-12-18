<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * 重写登陆页面
     */
    public function showLoginForm(){
        return view('admin.login.index');
    }

    /**
     * 重写guard认证
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * 重写退出登录
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->forget($this->guard()->getName());
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    /**
     * 重写验证时使用的用户名字段
     */
    protected function username()
    {
        return 'name';
    }
}
