@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加分类</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('posts.setting.create') }}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    <div class="box-body">


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">分类</label>
                            <div class="col-sm-10">
                                <input type="radio" name="audit" value="0" checked>不需要
                                <input type="radio" name="audit" value="1">需要
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">是否允许评论</label>
                            <div class="col-sm-10">
                                <input type="radio" name="audit" value="0" checked>不允许
                                <input type="radio" name="audit" value="1">允许
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">文章类型</label>
                            <div class="col-sm-10">
                                <input type="radio" name="audit" value="0" checked>待审核
                                <input type="radio" name="audit" value="1">已审核
                                <input type="radio" name="audit" value="2">不通过
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">文章类型</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="post_type" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">类型名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="post_name" value="">
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