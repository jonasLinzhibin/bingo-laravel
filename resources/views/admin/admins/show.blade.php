@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <!-- ./col -->
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">

                    <h3 class="box-title">查看资料</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>编号ID</dt>
                        <dd>{{$admin['id']}}</dd>
                        <dt>昵称</dt>
                        <dd>{{$admin['name']}}</dd>
                        <dt>邮箱</dt>
                        <dd>{{$admin['email']}}</dd>
                        <dt>创建时间</dt>
                        <dd>{{$admin['created_at']}}</dd>
                        <dt>更新日期</dt>
                        <dd>{{$admin['updated_at']}}</dd>

                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
@endsection