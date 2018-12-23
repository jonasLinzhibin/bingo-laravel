@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加文章</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('posts.create') }}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    <div class="box-body">


                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea name="content" class="form-control"  cols="30" rows="10">{{ old('content') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">状态</label>
                            <div class="col-sm-10">
                                <input type="radio" name="audit" value="0" checked>待审核
                                <input type="radio" name="audit" value="1">已审核
                                <input type="radio" name="audit" value="2">不通过
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