<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Post\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::where('deleted_at','=',null)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.post.index',compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $posts = Posts::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.post.trash',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.post.create');
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
            'title'=>'required',
            'content' => 'required',
            'audit' => 'required',
        ]);
        Posts::create($data);
        session()->flash('success','添加成功');
        return redirect()->route('posts.index');
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
        $post = Posts::findOrFail($id);
        return view('admin.posts.post.edit',compact('post'));
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
            'title'=>'required',
            'content' => 'required',
            'audit' => 'required',
        ]);
        $post = Posts::findOrFail($id);
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->audit = $data['audit'];

        if($post->save()){
            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();
        if($post->trashed()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('posts.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post = Posts::where('id', $id)->restore();
        if($post){
            session()->flash('success','恢复成功');
        }else{
            session()->flash('danger','恢复失败');
        }
        return redirect()->route('posts.index');
    }
}
