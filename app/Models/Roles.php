<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * 获得此角色下所有的菜单。
     */
    public function menus()
    {
        return $this->belongsToMany($this, 'role_has_menus', 'menus_id', 'role_id');
    }

}
