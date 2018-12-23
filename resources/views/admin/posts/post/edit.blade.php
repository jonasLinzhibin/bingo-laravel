@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <form action="{{ route('posts.update',$post) }}" method="post" class="form-horizontal">
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
                                <input type="text" class="form-control" name="title" value="{{$post->title}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea name="content" class="form-control"  cols="30" rows="10">{{$post->content }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <input type="radio" name="audit" value="0" @if($post->audit == 0) checked @endif>待审核
                                <input type="radio" name="audit" value="1" @if($post->audit == 1) checked @endif>已审核
                                <input type="radio" name="audit" value="2" @if($post->audit == 2) checked @endif>不通过
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
                        <label class="control-label col-md-3" style="padding:0;" for="date_d">发布时间:</label>
                        <div class="col-md-8"> <input id="date_d" class="form-control form-datetime" type="text" value="2018-09-30 22:32:26" name="publish_time" readonly=""></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">审核状态:</label>
                        <div class="col-md-8">
                            <select name="status" class="form-control">
                                <option value="1" selected="">已发布</option>
                                <option value="3">软删除</option>
                                <option value="0">待审核</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="istop">置顶:</label>
                        <div class="col-md-8">
                            <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="" name="istop" id="istop" value="1" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><span class="f12 pl-10 color-6">可在前台置顶显示</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="recommended">推荐:</label>
                        <div class="col-md-8">
                            <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="" name="recommended" id="recommended" value="1" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><span class="f12 pl-10 color-6">作为站内推荐</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">分类:</label>
                        <div class="col-md-8">
                            <select name="category_id" class="form-control">
                                <option value="1">未分类</option>
                                <option value="5">技术类</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="status">标签:</label>
                        <div class="col-md-8">
                            <select multiple="" name="tag_ids" class="form-control">
                                <option value="4">大数据</option>
                                <option value="7">运营</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="sort">排序:</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="sort" id="sort" value="99" placeholder="">
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