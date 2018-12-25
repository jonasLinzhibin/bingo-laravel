<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post\Posts;
use App\Models\Post\PostsCategory;
use App\Models\Post\PostsTags;
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
        $posts = Posts::where('deleted_at','=',null)->orderBy('created_at', 'desc')->with('tags')->paginate(10);

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
        $categorys = PostsCategory::getCategoryList();
        $tags = PostsTags::where('category_id',1)->get();
        return view('admin.posts.post.create',compact(['categorys','tags']));
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
            'title'=>'required',
            'content' => 'required',
            'audit' => 'required',
        ]);
        $data = $request->all();
        $post = Posts::create($data);

        if($post){

            $tags = $request['tag_ids']; // 获取输入的标签

            if (isset($tags)) {
                $post->tags()->sync($tags);  // 如果有标签选中与文章关联则更新文章标签
            } else {
                $post->tags()->detach(); // 如果没有选择任何与文章关联的标签则将之前关联标签解除
            }

            session()->flash('success','保存成功');
        }else{
            session()->flash('danger','保存失败');
        }

        session()->flash('success','添加成功');
        return redirect()->route('posts.posts.index');
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

        $post = Posts::with('tags')->find($id)->toArray();
        $post['tag_ids'] = [];
        foreach ($post['tags'] as $tag){
            $post['tag_ids'][] = $tag['id'];
        }


        $categorys = PostsCategory::getCategoryList();
        $tags = PostsTags::where('category_id',$post['category_id'])->get();

        return view('admin.posts.post.edit',compact(['post','categorys','tags']));
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
            'title'=>'required',
            'content' => 'required',
            'audit' => 'required',
        ]);
        $input = $request->all();
        $post = Posts::findOrFail($id);
        unset($input['tag_ids']);

        if($post->fill($input)->save()){


            $tags = $request['tag_ids']; // 获取输入的标签

            if (isset($tags)) {
                $post->tags()->sync($tags);  // 如果有标签选中与文章关联则更新文章标签
            } else {
                $post->tags()->detach(); // 如果没有选择任何与文章关联的标签则将之前关联标签解除
            }

            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }

        return redirect()->route('posts.posts.index');
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
        return redirect()->route('posts.posts.index');
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
        return redirect()->route('posts.posts.index');
    }
}
