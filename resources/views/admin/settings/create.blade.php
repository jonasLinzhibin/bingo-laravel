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
                <div class="box-body">
                <!-- form start -->
                {!! form($form) !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection