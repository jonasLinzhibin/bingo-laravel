@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">修改</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{route('config.update',$setting)}}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">配置名</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="key" value="{{$setting->key}}" @if($setting->status == 1) readonly="readonly" @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">配置值</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="value" value="{{$setting->value}}"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">配置描述</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" value="{{$setting->description}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">锁定</label>

                            <div class="col-sm-10">
                                <input type="radio" name="status" value="0" @if($setting->status == 0) checked @endif>正常
                                <input type="radio" name="status" value="1" @if($setting->status == 1) checked @endif>锁定
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