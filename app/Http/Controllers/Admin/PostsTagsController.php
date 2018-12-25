<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post\PostsTags;
use App\Models\Post\PostsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = PostsTags::orderBy('created_at', 'desc')->paginate(10);
        $categorys = PostsCategory::getCategoryList();
        return view('admin.posts.tags.index',compact(['tags','categorys']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = PostsCategory::getCategoryList();
        return view('admin.posts.tags.create',compact(['categorys']));
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
            'name'=>'required',
            'category_id'=>'required',
            'sort' => 'required',
        ]);

        PostsTags::create($data);
        session()->flash('success','添加成功');
        return redirect()->route('posts.tags.index');
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
        $tag = PostsTags::findOrFail($id);
        $categorys = PostsCategory::getCategoryList();
        return view('admin.posts.tags.edit',compact(['tag','categorys']));
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
            'name'=>'required',
            'category_id'=>'required',
            'sort' => 'required',
        ]);

        $tag = PostsTags::find($id);
        if($tag->fill($data)->save()){
            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }
        return redirect()->route('posts.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = PostsTags::findOrFail($id);
        $tag->posts()->detach();
        if($tag->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('posts.tags.index');
    }
}
