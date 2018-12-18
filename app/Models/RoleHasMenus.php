<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasMenus extends Model
{
    public $table='role_has_menus';
    /*
    * 通过角色ID获取菜单
    */
    static function getMenusByRoles($ids)
    {
        return self::whereIn('role_id',$ids)->pluck('menus_id');
    }
}
