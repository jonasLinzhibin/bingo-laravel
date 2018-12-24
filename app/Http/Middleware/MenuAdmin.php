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

            $breadcrumbs = $this->makeBreadcrumbs();
            view()->share('breadCrumbs',$breadcrumbs);
        }

        return $next($request);
    }

    /**
     * 生成左侧菜单
     */
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
                        $path = '/'.app('request')->path();
                        if($path == $sub['uri']){
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

                $path = '/'.app('request')->path();
                if($path == $item['uri']){
                    $menu->setActiveClass('active');
                    $menu->setActiveFromUrl($item['uri']);
                }

            }

        });

        return $menu->render();
    }

    /**
     * 生成面包屑菜单
     */
    public function makeBreadcrumbs(){

        $menus = new Menus();
        $items = $menus->sidebarMenu();

        $nav = Menu::build($items, function ($menu, $item) {

                $menu->addClass('breadcrumb');

                if(!empty($item['child'])){

                    foreach ($item['child'] as $key => $sub){

                        $path = '/'.app('request')->path();
                        if($path == $sub['uri']){

                            //添加页面标题
                            $pageTitle = '<h1>    '.$item['title'].'    <small></small>    </h1>';
                            $menu->prepend($pageTitle);
                            //添加菜单
                            $header = '<i class="fa '.$item['icon'].'"></i> '.$item['title'];
                            $menu->link($item['uri'],$header);
                            //添加子菜单
                            $title_icon = '<i class="fa '.$sub['icon'].'"></i> '.$sub['title'];
                            $title = $sub['icon'] ? $title_icon : $sub['title'] ;
                            $title = $sub['title'] ;

                            $menu->link($sub['uri'],$title);
                        }
                    }


                }else{

                    if(strstr(app('request')->url(),$item['uri'])){
                        //添加页面标题
                        $pageTitle = '<h1>    '.$item['title'].'    <small></small>    </h1>';
                        $menu->prepend($pageTitle);
                        //添加菜单
                        $title = '<i class="fa '.$item['icon'].'"></i> '.$item['title'];
                        $menu->link($item['uri'],$title);
                    }

                }


        });


        return $nav->render();
    }


}
