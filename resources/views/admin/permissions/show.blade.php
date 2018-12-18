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
                        <dd>{{$permissions['id']}}</dd>
                        <dt>昵称</dt>
                        <dd>{{$permissions['name']}}</dd>
                        <dt>所属组</dt>
                        <dd>{{$permissions['guard_name']}}</dd>
                        <dt>创建时间</dt>
                        <dd>{{$permissions['created_at']}}</dd>
                        <dt>更新日期</dt>
                        <dd>{{$permissions['updated_at']}}</dd>

                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
@endsection