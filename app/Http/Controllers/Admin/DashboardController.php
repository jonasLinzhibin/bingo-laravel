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

        return view('admin.dashboard.index');
    }
}
