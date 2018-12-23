<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Post\PostsCategory;
use App\Models\Admin\Post\PostsConfigs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post_configs = PostsConfigs::getConfigs();
        $list = PostsCategory::orderBy('sort','asc')->get()->toArray();

        $categorys = [];
        if ($list) {
            $categorys = setChild($list);
        }
        return view('admin.posts.category.index',compact(['categorys','post_configs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'slug' => 'required',
            'parent_id' => 'required',
            'taxonomy' => 'required',
            'sort' => 'required',
        ]);

        PostsCategory::create($data);
        session()->flash('success','添加成功');
        return redirect()->route('category.index');
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

        $configs = PostsConfigs::orderBy('sort','asc')->get()->toArray();
        $list = PostsCategory::orderBy('sort','asc')->get()->toArray();

        $categorys = [];
        if ($list) {
            $categorys = setChild($list);
        }
        $category = PostsCategory::findOrFail($id);
        return view('admin.posts.category.edit',compact(['category','categorys','configs']));
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
            'name'=>'required',
            'slug' => 'required',
            'taxonomy' => 'required',
            'sort' => 'required',
        ]);

        $category = PostsCategory::find($id);
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->taxonomy = !empty($request->taxonomy) ? $request->taxonomy : 0;
        $category->seo_title = $request->seo_title ? $request->seo_title : '';
        $category->seo_keywords = $request->seo_keywords ? $request->seo_keywords : '';
        $category->seo_description = $request->seo_description ? $request->seo_description : '';
        $category->sort = $request->sort;


        if($category->save()){
            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * 删除
     */
    public function del($id)
    {
        $category = PostsCategory::findOrFail($id);
        if($category->delete()){
            return ['status'=>'success','msg'=>'删除成功','uri'=>route('category.index')];
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
                'sort'=>$num++,
                'parent_id'=>0,
            ];

            if(isset($item['children'])){
                foreach ($item['children'] as $item2) {
                    $data[] = [
                        'id' => $item2['id'],
                        'sort' => $num++,
                        'parent_id'=>$item['id'],
                    ];
                }
            }
        }

        $category = new PostsCategory();
        $res = $category->updateBatch($data);

        if($res !==false){
            return ['status'=>'success','msg'=>'保存成功','uri'=>route('category.index')];
        }else{
            return ['status'=>'danger','msg'=>'保存失败'];
        }

    }
}
