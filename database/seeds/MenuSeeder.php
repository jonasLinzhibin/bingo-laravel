<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(['title' => '仪表盘','uri' => '/admin/dashboard','parent_id'=>'0','order'=>'1','icon'=>'fa fa-tachometer']);
        $mamage = Menu::create(['title' => '管理','uri' => '/admin/admins','parent_id'=>'0','order'=>'2','icon'=>'fa fa-cog']);

        $parent_id = $mamage->id;
        Menu::create(['title' => '站点配置','uri' => '/admin/config','parent_id'=>$parent_id,'order'=>'1','icon'=>'fa fa-bars']);
        Menu::create(['title' => '菜单列表','uri' => '/admin/menus','parent_id'=>$parent_id,'order'=>'2','icon'=>'fa fa-bars']);
        Menu::create(['title' => '用户列表','uri' => '/admin/admins','parent_id'=>$parent_id,'order'=>'3','icon'=>'fa fa-bars']);
        Menu::create(['title' => '权限列表','uri' => '/admin/permissions','parent_id'=>$parent_id,'order'=>'4','icon'=>'fa fa-bars']);
        Menu::create(['title' => '角色列表','uri' => '/admin/roles','parent_id'=>$parent_id,'order'=>'5','icon'=>'fa fa-bars']);
        Menu::create(['title' => '会员列表','uri' => '/admin/users','parent_id'=>$parent_id,'order'=>'6','icon'=>'fa fa-bars']);

        $tools = Menu::create(['title' => '工具','uri' => '/admin/admins','parent_id'=>'0','order'=>'3','icon'=>'fa fa-cog']);
        $parent_id = $tools->id;

        Menu::create(['title' => '文件管理','uri' => '/admin/medias','parent_id'=>$parent_id,'order'=>'1','icon'=>'fa fa-bars']);
        Menu::create(['title' => '站内信','uri' => '/admin/message','parent_id'=>$parent_id,'order'=>'2','icon'=>'fa fa-bars']);

        $posts = Menu::create(['title' => '文章管理','uri' => '/admin/posts','parent_id'=>'0','order'=>'5','icon'=>'fa fa-bars']);
        $parent_id = $posts->id;
        Menu::create(['title' => '文章列表','uri' => '/admin/posts','parent_id'=>$parent_id,'order'=>'1','icon'=>'fa fa-bars']);
        Menu::create(['title' => '模块设置','uri' => '/admin/posts/setting','parent_id'=>$parent_id,'order'=>'2','icon'=>'fa fa-bars']);
        Menu::create(['title' => '文章分类','uri' => '/admin/posts/category','parent_id'=>$parent_id,'order'=>'3','icon'=>'fa fa-bars']);
        Menu::create(['title' => '回收站','uri' => '/admin/posts/trash','parent_id'=>$parent_id,'order'=>'4','icon'=>'fa fa-bars']);
        Menu::create(['title' => '评论列表','uri' => '/admin/posts/comments','parent_id'=>$parent_id,'order'=>'5','icon'=>'fa fa-bars']);
        Menu::create(['title' => '标签列表','uri' => '/admin/posts/tags','parent_id'=>$parent_id,'order'=>'6','icon'=>'fa fa-bars']);

    }
}
