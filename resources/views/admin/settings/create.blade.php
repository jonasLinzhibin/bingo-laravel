@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加配置</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('config.store') }}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="key" value="{{ old('key') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">值</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="value" value="{{ old('value') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                                {{--<button type="reset" class="btn btn-default">重置</button>--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                {{--<div class="box-footer">--}}
                {{--<button type="reset" class="btn btn-default">重置</button>--}}
                {{--<button type="submit" class="btn btn-info pull-right">保存</button>--}}
                {{--</div>--}}
                <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection