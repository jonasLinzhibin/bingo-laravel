<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class AdminsController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Admin::paginate(10);
        $roles = Role::all();
        return view('admin.admins.index', compact(['items','roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create',compact(['roles']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
        ]);
        $data['password'] = bcrypt($data['password']);
        //注册用户
        $admin = Admin::create($data);

        if (isset($data['avatar'])) {
            $admin->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $roles = $request['roles']; // 获取输入的角色字段
        // 检查是否某个角色被选中
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $admin->assignRole($role_r); //角色分配给用户：
            }
        }
        session()->flash('success','添加成功');
        return redirect()->route('admins.index');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.admins.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $user = auth()->guard('admin')->user();
        $this->authorizeForUser($user,'update',$admin);
        $roles = Role::all();
        //$admin->getFirstMediaUrl('avatar');


        return view('admin.admins.edit',compact(['admin','roles']));
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
        $admin = Admin::findOrFail($id);
        $user = auth()->guard('admin')->user();
        $this->authorizeForUser($user,'update',$admin);
        $data = $this->validate($request,[
            'name'=>'required|min:3',
            'password'=>'nullable|min:5|confirmed',
            'avatar'=>'nullable|image',
        ]);

        $admin = Admin::findOrFail($id);
        if (isset($data['avatar'])) {
            $mediaItems = $admin->getFirstMedia('avatar');
            if($mediaItems)$admin->deleteMedia($mediaItems);
            $admin->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        $admin->name = $request->name;
        if($request->password){
            $admin->password = bcrypt($request->password);
        }
        $roles = $request['roles'];


        if($admin->save()){

            if (isset($roles)) {
                $admin->roles()->sync($roles);  // 如果有角色选中与用户关联则更新用户角色
            } else {
                $admin->roles()->detach(); // 如果没有选择任何与用户关联的角色则将之前关联角色解除
            }

            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }

        return redirect()->route('admins.index',$admin);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
//        $this->authorize('delete',$admin);
        if($admin->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('admins.index');
    }
}
