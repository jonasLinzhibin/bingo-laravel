@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">消息列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('message.create') }}" type="button" class="btn btn-block btn-info">发送通知</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>值</th>
                            <th>操作</th>
                        </tr>

                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
