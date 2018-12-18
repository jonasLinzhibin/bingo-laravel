<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Traits\HasRoles;

class UsersController extends Controller
{
    use HasRoles;

    protected $guard_name = 'admin';

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
        $items = User::paginate(10);
        return view('admin.users.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
        User::create($data);

        session()->flash('success','添加成功');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.edit',compact('users'));
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
            'name'=>'required|min:3',
            'password'=>'nullable|min:5|confirmed'
        ]);
        $users = User::findOrFail($id);
        $users->name = $request->name;
        if($request->password){
            $users->password = bcrypt($request->password);
        }
        $users->save();
        session()->flash('success','修改成功');
        return redirect()->route('users.index',$users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        if($users->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('users.index');
    }
}
