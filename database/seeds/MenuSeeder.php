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
        Menu::create(['title' => '控制面板','uri' => '#','parent_id'=>'0','order'=>'1','icon'=>'fa fa-bars']);
        $mamage = Menu::create(['title' => '管理','uri' => '/admin/admins','parent_id'=>'0','order'=>'2','icon'=>'fa fa-bars']);

        $parent_id = $mamage->id;
        Menu::create(['title' => '权限','uri' => '/admin/permissions','parent_id'=>$parent_id,'order'=>'3','icon'=>'fa fa-bars']);
        Menu::create(['title' => '菜单','uri' => '/admin/menus','parent_id'=>$parent_id,'order'=>'4','icon'=>'fa fa-bars']);
        Menu::create(['title' => '会员','uri' => '/admin/users','parent_id'=>$parent_id,'order'=>'5','icon'=>'fa fa-bars']);
        Menu::create(['title' => '用户','uri' => '/admin/admins','parent_id'=>$parent_id,'order'=>'1','icon'=>'fa fa-bars']);
        Menu::create(['title' => '角色','uri' => '/admin/roles','parent_id'=>$parent_id,'order'=>'2','icon'=>'fa fa-bars']);

        $medias = Menu::create(['title' => '文件管理','uri' => '/admin/medias','parent_id'=>'0','order'=>'3','icon'=>'fa fa-bars']);
        $parent_id = $medias->id;
        Menu::create(['title' => '文件列表','uri' => '/admin/medias','parent_id'=>$parent_id,'order'=>'6','icon'=>'fa fa-bars']);


    }
}
