<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleHasMenus;
use DB;

class Menu extends Model
{
    protected $table = 'menus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','icon', 'parent_id', 'uri','order',
    ];

    /**
     * 获得此菜单下所有的角色。
     */
    public function roles(){
        return $this->belongsToMany($this, 'role_has_menus', 'menus_id', 'role_id');

    }

    /**
     * 是否包含某个角色。
     */
    public function hasRole($role){
        if($role->id){
            $roleHasMenu = new RoleHasMenus();
            return $roleHasMenu->where('role_id',$role->id)->where('menu_id',$this->id)->count();
        }
        return false;
    }

    /*
    * 获取菜单数据
    */
    public function getMenuList(){
        return $this->sortMenuSetCache();
    }

    /*
    * 递归调用菜单数据
    */
    public function sortMenu($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return [];
        }

        foreach ($menus as $key => $value) {
            if ($value['parent_id'] == $pid) {
                $arr[$key] = $value;
                $arr[$key]['child'] = self::sortMenu($menus,$value['id']);
            }
        }
        return $arr;
    }



    /*
    * 排序子菜单并缓存
    */
    public function sortMenuSetCache()
    {
        $menus = $this->orderBy('order','asc')->get()->toArray();
        if ($menus) {
            $menuList = $this->sortMenu($menus);
            foreach ($menuList as $key => $value) {
                if ($value['child']) {
                    $sort = array_column($value['child'], 'order');
                    array_multisort($sort,SORT_ASC,$value['child']);
                }
            }
            return $menuList;
        }
        return [];
    }



    /*
    * 获取左边菜单
    */
    public function sidebarMenu()
    {
        $hasRoles = Admin::hasRoles();
        $hasMenu = RoleHasMenus::getMenusByRoles($hasRoles->ids);

        $admin = \Auth::guard('admin')->user();
        if($admin->id == 1){
            $menus = $this->orderBy('order','asc')->get()->toArray();
        }else{
            $menus = $this->whereIn('id',$hasMenu)->orderBy('order','asc')->get()->toArray();
        }

        if ($menus) {
            $menuList = $this->sortMenu($menus);
            foreach ($menuList as $key => $value) {
                if ($value['child']) {
                    $sort = array_column($value['child'], 'order');
                    array_multisort($sort,SORT_ASC,$value['child']);
                }
            }
            return $menuList;
        }
        return [];
    }

    //同时更新多个记录，参数，表名，数组（别忘了在一开始use DB;）
    public function updateBatch($multipleData = array(), $tableName = ""){

        if( $tableName && !empty($multipleData) ) {
            // column or fields to update
            $updateColumn = array_keys($multipleData[0]);
            $referenceColumn = $updateColumn[0]; //e.g id
            unset($updateColumn[0]);
            $whereIn = "";

            $q = "UPDATE `".$tableName."` SET `";
            foreach ( $updateColumn as $uColumn ) {
                $q .=  $uColumn."` = CASE ";

                foreach( $multipleData as $data ) {
                    $q .= "WHEN ".$referenceColumn." = ".$data[$referenceColumn]." THEN '".$data[$uColumn]."' ";
                }
                $q .= "ELSE `".$uColumn."` END, ";
            }
            foreach( $multipleData as $data ) {
                $whereIn .= "'".$data[$referenceColumn]."', ";
            }
            $q = rtrim($q, ", ")." WHERE ".$referenceColumn." IN (".  rtrim($whereIn, ', ').")";

            // Update
            return \DB::update(DB::raw($q));

        } else {
            return false;
        }
    }



}
