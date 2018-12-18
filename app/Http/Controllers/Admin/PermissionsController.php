<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Permission::paginate(10);
        return view('admin.permissions.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.permissions.create',compact('roles'));
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
            'name' => 'required|min:2',
            'guard_name' => 'required|min:2',
        ]);
        $input = $request->all();
        $permission= new Permission();

        if($permission->fill($input)->save()){
            session()->flash('success','添加成功');
        }else{
            session()->flash('danger','添加失败');
        }
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = Permission::findOrFail($id);
        return view('admin.permissions.show',compact('permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);
        return view('admin.permissions.edit',compact(['permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|min:2',
        ]);
        $input = $request->all();
        $permissions = Permission::findOrFail($id);
        $permissions->fill($input)->save();

        session()->flash('success','修改成功');
        return redirect()->route('permissions.index',$permissions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissions = Permission::findOrFail($id);
        // 让特定权限无法删除
        if ($permissions->name == "Administer roles & permissions") {
            session()->flash('danger','特定权限无法删除');
            return redirect()->route('permissions.index');
        }

        if($permissions->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('permissions.index');
    }
}
