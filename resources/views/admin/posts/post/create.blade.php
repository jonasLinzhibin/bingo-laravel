@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <form action="{{ route('posts.posts.store') }}" method="post" class="form-horizontal">
            <div class="col-md-8">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加文章</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    {{ csrf_field() }}
                    <div class="box-body">


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{old('title')}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="content" cols="10" rows="80">{{old('content')}}</textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">扩展面板</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label class="control-label col-md-3" for="status">审核状态:</label>
                            <div class="col-md-8">
                                <select name="audit" class="form-control">

                                    <option value="0">待审核</option>
                                    <option value="1">已审核</option>
                                    <option value="2">不通过</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" >置顶:</label>
                            <div class="col-md-8">
                                <input type="checkbox" name="is_top" id="is_top" value="1">
                                <label for="is_top">可在前台置顶显示</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="recommended">推荐:</label>
                            <div class="col-md-8">
                                <input type="checkbox" name="recommended" id="recommended" value="1">
                                <label for="recommended">作为站内推荐</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="status">分类:</label>
                            <div class="col-md-8">
                                <select name="category_id" class="form-control">
                                    @foreach($categorys as $item)
                                        <option value="{{$item['id']}}" >{{$item['html']}}{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="status">标签:</label>
                            <div class="col-md-8">
                                <select multiple="" name="tag_ids" class="form-control">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" >{{$tag['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="sort">排序:</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="sort" id="sort" value="{{old('sort',50) }}" placeholder="">
                            </div>
                        </div>
                    </div>
                </div><!--box-->
            </div>

            <!-- /.box-footer -->
            <div class="col-md-12">
                <div class="box box-footer">

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            CKEDITOR.replace('content')
        });

    </script>
@endsection