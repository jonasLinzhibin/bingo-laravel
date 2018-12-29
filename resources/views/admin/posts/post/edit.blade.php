@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <form action="{{ route('posts.posts.update',$post['id']) }}" method="post" class="form-horizontal">
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加文章</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{$post['title']}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="content" rows="10" cols="80">{{$post['content'] }}</textarea>
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
                        <label class="control-label col-md-3" >发布时间:</label>
                        <div class="col-md-8"> <input id="date_d" class="form-control form-datetime" type="text" value="{{$post['created_at'] }}" readonly=""></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">审核状态:</label>
                        <div class="col-md-8">
                            <select name="audit" class="form-control">

                                <option value="0" @if($post['audit'] == 0) selected @endif>待审核</option>
                                <option value="1" @if($post['audit'] == 1) selected @endif>已审核</option>
                                <option value="2" @if($post['audit'] == 2) selected @endif>不通过</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" >置顶:</label>
                        <div class="col-md-8">
                            <input type="checkbox" name="is_top" id="is_top" value="1" @if($post['is_top']) checked @endif >
                            <label for="is_top">可在前台置顶显示</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="recommended">推荐:</label>
                        <div class="col-md-8">
                            <input type="checkbox" name="recommended" id="recommended" value="1"  @if($post['recommended']) checked @endif >
                            <label for="recommended">作为站内推荐</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">分类:</label>
                        <div class="col-md-8">
                            <select name="category_id" class="form-control">
                                @foreach($categorys as $item)
                                <option value="{{$item['id']}}" @if($post['category_id'] == $item['id']) selected @endif>{{$item['html']}}{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">标签:</label>
                        <div class="col-md-8">
                            <select multiple="" name="tag_ids" class="form-control">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" @if(in_array($tag->id,$post['tag_ids'])) selected @endif>{{$tag['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="sort">排序:</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="sort" id="sort" value="{{$post['sort'] }}" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" >封面图:</label>
                        <div class="col-md-8">
                            <input type="hidden" class="img-id" name="thumb" value=" ">
                            <div class="upload-container">
                                <div class="upload-picker">
                                    <i class="upload-btn fa fa-plus"></i>
                                    <div class="picker1"></div>
                                </div>
                            </div>
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

            CKEDITOR.replace( 'content');

            initWebUploader('.picker1', true, WEBUPLOADER_UPLOADER_URL, '');


        });
    </script>
@endsection