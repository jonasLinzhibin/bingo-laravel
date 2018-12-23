@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">配置</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('setting.update',$config) }}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">前台发布审核</label>
                            <div class="col-sm-10">
                                <input type="radio" name="need_audit" value="0" @if($config->need_audit == 0) checked @endif>不需要
                                <input type="radio" name="need_audit" value="1" @if($config->need_audit) checked @endif>需要
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">是否允许评论</label>
                            <div class="col-sm-10">
                                <input type="radio" name="allow_comment" value="0" @if($config->allow_comment == 0) checked @endif>不允许
                                <input type="radio" name="allow_comment" value="1" @if($config->allow_comment) checked @endif>允许
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">文章类型</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="post_type" value="{{$config->post_type}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">类型名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="post_name" value="{{$config->post_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">排序</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sort" value="{{$config->sort}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection