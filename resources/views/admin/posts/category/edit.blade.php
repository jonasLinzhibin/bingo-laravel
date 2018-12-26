@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{route('posts.category.update',$category)}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body fields-group">
                        <div class="form-group ">
                            <label class="col-sm-2  control-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" value="{{$category->id}}" class="form-control" placeholder="" readonly>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parent_id" class="col-sm-2 control-label">父类</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="parent_id">
                                <select class="form-control js-select2" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                    <option value="0">顶级</option>
                                    @foreach($categorys as $item)
                                        <option value="{{$item['id']}}" @if($item['id'] == $category->parent_id) selected @endif >{{$item['name']}}</option>
                                        @if(!empty($item['child']))
                                            @foreach($item['child'] as $child)
                                                <option value="{{$child['id']}}" @if($child['id'] == $category->parent_id) selected @endif >一一{{$child['name']}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="title" class="col-sm-2  control-label">名称</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="uri" class="col-sm-2  control-label">分类别名</label>
                            <div class="col-sm-8">
                                <input type="text" name="slug" value="@if(!empty($category->slug)){{$category->slug}}@endif" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="roles" class="col-sm-2  control-label">分类类型</label>
                            <div class="col-sm-8">
                                <select class="form-control js-select2 " name="taxonomy" data-value="" tabindex="-1" aria-hidden="true">
                                    @foreach($configs as $config)
                                        <option value="{{$config['id']}}" @if($config['id'] == $category->taxonomy) selected @endif >{{$config['post_type']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="uri" class="col-sm-2  control-label">SEO标题</label>
                            <div class="col-sm-8">
                                <input type="text" name="seo_title" value="@if(!empty($category->seo_title)){{$category->seo_title}}@endif" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="uri" class="col-sm-2  control-label">SEO关键字</label>
                            <div class="col-sm-8">
                                <input type="text" name="seo_keywords" value="@if(!empty($category->seo_keywords)){{$category->seo_keywords}}@endif" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uri" class="col-sm-2  control-label">描述（SEO）</label>
                            <div class="col-sm-8">
                                <input type="text" name="seo_description" value="@if(!empty($category->seo_description)){{$category->seo_description}}@endif" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">排序</label>
                            <div class="col-sm-8">
                                <input type="text" name="sort" value="@if(!empty($category->sort)){{$category->sort}}@endif" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">提交</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
