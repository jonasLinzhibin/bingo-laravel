<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /*
     * 显示后台管理模板首页
     */
    public function index(){
//        dd(auth('admin')->admins());
//        $admin = session('admin');
//        dd($admin);
        return view('admin.dashboard.index');
    }
}
