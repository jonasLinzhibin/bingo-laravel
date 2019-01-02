<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

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


    /*
    * 获取菜单数据
    */
    public function getMenuList(){
        return $this->orderBy('order','asc')->get()->toArray();
    }


    /*
    * 获取左边菜单
    */
    public function sidebarMenu()
    {

        $menus = [];
        $admin = Auth::guard('admin')->user();
        if($admin->id == 1){
            $menus = $this->orderBy('order','asc')->get()->toArray();
        }else{

            $hasRoles = Admin::hasRoles();
            if(!empty($hasRoles->ids)){
                $hasMenu = RoleHasMenus::getMenusByRoles($hasRoles->ids);
                $menus = $this->whereIn('id',$hasMenu)->orderBy('order','asc')->get()->toArray();
            }
        }

        if ($menus) {
            $menuList = setChild($menus);
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


    //批量更新
    public function updateBatch($multipleData = [])
    {
        try {
            if (empty($multipleData)) {
                throw new \Exception("数据不能为空");
            }
            $tableName = DB::getTablePrefix() . $this->getTable(); // 表名
            $firstRow  = current($multipleData);

            $updateColumn = array_keys($firstRow);
            // 默认以id为条件更新，如果没有ID则以第一个字段为条件
            $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
            unset($updateColumn[0]);
            // 拼接sql语句
            $updateSql = "UPDATE " . $tableName . " SET ";
            $sets      = [];
            $bindings  = [];
            foreach ($updateColumn as $uColumn) {
                $setSql = "`" . $uColumn . "` = CASE ";
                foreach ($multipleData as $data) {
                    $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                    $bindings[] = $data[$referenceColumn];
                    $bindings[] = $data[$uColumn];
                }
                $setSql .= "ELSE `" . $uColumn . "` END ";
                $sets[] = $setSql;
            }
            $updateSql .= implode(', ', $sets);
            $whereIn   = collect($multipleData)->pluck($referenceColumn)->values()->all();
            $bindings  = array_merge($bindings, $whereIn);
            $whereIn   = rtrim(str_repeat('?,', count($whereIn)), ',');
            $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
            // 传入预处理sql语句和对应绑定数据
            return DB::update($updateSql, $bindings);
        } catch (\Exception $e) {
            return false;
        }
    }



}
