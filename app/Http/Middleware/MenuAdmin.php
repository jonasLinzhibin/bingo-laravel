<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Menu\Laravel\Menu;
use App\Models\Menu as Menus;

class MenuAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax() || !$request->wantsJson()) {

            $menu = $this->makeSidebarMenu();
            view()->share('sidebarMenu',$menu);
        }

        return $next($request);
    }

    public function makeSidebarMenu(){

        $menus = new Menus();
        $items = $menus->sidebarMenu();
        $menu = Menu::build($items, function ($menu, $item) {

            //判断是否选中
            $menu->addClass('sidebar-menu');
            $menu->setAttribute('data-widget', 'tree');
            if(!empty($item['child'])){

                //添加菜单
                $header = '<a href="'.$item['uri'].'"><i class="fa '.$item['icon'].'"></i>
                    <span>'.$item['title'].'</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a>';
                $child = $item['child'];
                //添加子菜单
                $menu->submenu($header, function (Menu $menu) use ($child) {
                    foreach ($child as $sub){
                        $menu->link($sub['uri'],$sub['title']);
                        //添加 li 样式
                        $menu->addParentClass('treeview');

                        //添加选中项
                        if(strstr(app('request')->url(),$sub['uri'])){
                            $menu->setActiveClass('menu-open');
                            $menu->setActiveFromUrl($sub['uri']);
                            $menu->setExactActiveClass('active');
                        }

                    }
                });
                $menu->addItemClass('treeview-menu');

            }else{

                //添加菜单
                $header = '<i class="fa '.$item['icon'].'"></i>
                    <span>'.$item['title'].'</span>';
                $menu->link($item['uri'],$header);

                if(strstr(app('request')->url(),$item['uri'])){
                    $menu->setActiveClass('active');
                    $menu->setActiveFromUrl($item['uri']);
                }

            }



        });



        return $menu->render();
    }
}
