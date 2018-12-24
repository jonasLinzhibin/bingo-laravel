<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post\PostsConfigs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = PostsConfigs::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.setting.index',compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.setting.create');
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
            'need_audit'=>'required',
            'allow_comment' => 'required',
            'post_type' => 'required',
            'post_name' => 'required',
            'sort' => 'required',
        ]);

        PostsConfigs::create($data);
        session()->flash('success','添加成功');
        return redirect()->route('posts.setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = PostsConfigs::find($id);
        return view('admin.posts.setting.edit',compact(['config']));
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
            'need_audit'=>'required',
            'allow_comment' => 'required',
            'post_type' => 'required',
            'post_name' => 'required',
            'sort' => 'required',
        ]);

        $config = PostsConfigs::find($id);
        $config->need_audit = $request->need_audit;
        $config->allow_comment = $request->allow_comment;
        $config->post_type = $request->post_type;
        $config->post_name = $request->post_name;
        $config->sort = $request->sort;


        if($config->save()){
            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }
        return redirect()->route('posts.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $config = PostsConfigs::findOrFail($id);
        if($config->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('posts.setting.index');
    }
}
