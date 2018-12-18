<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 重置角色和权限的缓存
        app()['cache']->forget('spatie.permission.cache');

        // 创建权限
        Permission::create(['name' => 'edit articles','guard_name' => 'admin']);
        Permission::create(['name' => 'delete articles','guard_name' => 'admin']);
        Permission::create(['name' => 'publish articles','guard_name' => 'admin']);
        Permission::create(['name' => 'unpublish articles','guard_name' => 'admin']);
        Permission::create(['name' => 'permission1 articles','guard_name' => 'admin']);
        Permission::create(['name' => 'permission2 articles','guard_name' => 'admin']);
        Permission::create(['name' => 'permission3 articles','guard_name' => 'admin']);
        Permission::create(['name' => 'permission4 articles','guard_name' => 'admin']);
        Permission::create(['name' => 'permission5 articles','guard_name' => 'admin']);

        // 创建角色并赋予已创建的权限
        $role = Role::create(['name' => 'adminer','guard_name' => 'admin']);
        $role->givePermissionTo('publish articles');
        $role->givePermissionTo('unpublish articles');

        $role = Role::create(['name' => 'writer','guard_name' => 'admin']);
        $role->givePermissionTo('edit articles');
        $role->givePermissionTo('delete articles');

    }
}
