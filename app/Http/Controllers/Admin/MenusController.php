<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Menu as Menus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
class MenusController extends Controller
{
    public function index()
    {

        $roles = Role::all();
        $menu = new Menus();
        $menus = $menu->getMenuList();
        return view('admin.menus.index',compact(['menus','roles']));
    }

    /**
     * 保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'title' => 'required|min:2',
            'uri' => 'required',
        ]);

        $menu = Menus::create($data);
        if($menu){

            $roles = $request['roles']; // 获取输入的角色字段

            if (isset($roles)) {
                $menu->roles()->sync($roles);  // 如果有角色选中与用户关联则更新用户角色
            } else {
                $menu->roles()->detach(); // 如果没有选择任何与用户关联的角色则将之前关联角色解除
            }

            session()->flash('success','保存成功');
        }else{
            session()->flash('danger','保存失败');
        }

        return redirect()->route('menus.index');
    }



    /**
     * 编辑
     */
    public function edit($id)
    {
        $roles = Role::all();
        $menu = new Menus();
        $menus = $menu->getMenuList();

        $hasRoles = Admin::hasRoles();
        $menu = Menus::findOrFail($id);

        return view('admin.menus.edit',compact(['menu','menus','roles','hasRoles']));
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
        $data = $this->validate($request,[
            'title'=>'required|min:2',
            'uri'=>'required',
            'icon'=>'required',
        ]);

        $menu = Menus::find($id);
        $menu->title = $request->title;
        $menu->parent_id = $request->parent_id;
        $menu->uri = $request->uri;
        $menu->icon = $request->icon;

        $roles = $request['roles'];

        if($menu->save()){

            if (isset($roles)) {
                $menu->roles()->sync($roles);  // 如果有角色选中与菜单关联则更新菜单角色
            } else {
                $menu->roles()->detach(); // 如果没有选择任何与用户关联的角色则将之前关联角色解除
            }

            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }
        return redirect()->route('menus.index');

    }
    /**
     * 删除
   */
    public function del($id)
    {
        $menu = Menus::findOrFail($id);
        if($menu->delete()){
            return ['status'=>'success','msg'=>'删除成功','uri'=>route('menus.index')];
        }else{
            return ['status'=>'danger','msg'=>'删除失败'];
        }
    }
    /**
     * 保存排序
     */
    public function sort()
    {
        $input = request()->only('_order');
        $order = json_decode($input['_order'],true);

        $data = [];
        $parent = [];
        $num = 1;
        foreach ($order as $item){

            $data[] = [
                'id'=>$item['id'],
                'order'=>$num++,
                'parent_id'=>0,
            ];

            if(isset($item['children'])){
                foreach ($item['children'] as $item2) {
                    $data[] = [
                        'id' => $item2['id'],
                        'order' => $num++,
                        'parent_id'=>$item['id'],
                    ];
                }
            }
        }

        $menu = new Menus();
        $res = $menu->updateBatch($data);

        if($res !==false){
            return ['status'=>'success','msg'=>'保存成功','uri'=>route('menus.index')];
        }else{
            return ['status'=>'danger','msg'=>'保存失败'];
        }

    }
}
