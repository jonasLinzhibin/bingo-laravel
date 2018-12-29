<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Post\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Helpers\Util\Sysinfo;
use App\User;

class DashboardController extends Controller
{
    /*
     * 显示后台管理模板首页
     */
    public function index(){
        $sys = new Sysinfo();
        $sysinfos = $sys->info();


        $user = new User();
        $posts = new Posts();
        $admins = new Admin();
        $report = [];
        $report['user_num'] = $user->counts();
        $report['posts_num'] = $posts->counts();
        $report['admins_num'] = $admins->counts();

        return view('admin.dashboard.index',compact(['sysinfos','report']));
    }



}
