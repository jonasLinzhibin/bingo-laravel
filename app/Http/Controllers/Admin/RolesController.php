<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.menu');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Role::paginate(10);
        $permissions = Permission::all();
        return view('admin.roles.index',compact(['items','permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:roles|max:10',
            'guard_name' => 'required|min:2',
            'permissions' =>'required',
        ]);
        $input = $request->except(['permissions','s']);
        $permissions = $request['permissions'];

        $role = new Role();
        if($role->fill($input)->save()){
            // 遍历选择的权限
            foreach ($permissions as $permission_id) {
                $p = Permission::where('id', '=', $permission_id)->firstOrFail();
                // 获取新创建的角色并分配权限
                $role = Role::where('name', '=', $input['name'])->first();
                $role->givePermissionTo($p);
            }

            session()->flash('success','添加成功');
        }else{
            session()->flash('danger','添加失败');
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.show',compact(['role','permissions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit',compact(['role', 'permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);
        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];

        $role = Role::findOrFail($id);

        if($role->fill($input)->save()){
            $p_all = Permission::all();//获取所有权限
            foreach ($p_all as $p) {
                $role->revokePermissionTo($p); // 移除与角色关联的所有权限
            }

            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //从数据库中获取相应权限
                $role->givePermissionTo($p);  // 分配权限到角色
            }

        }

        session()->flash('success','修改成功');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        if($roles->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('roles.index');
    }
}
