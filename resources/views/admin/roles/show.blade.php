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
                        <dd>{{$role->id}}</dd>
                        <dt>角色名称</dt>
                        <dd>{{$role->name}}</dd>
                        <dt>所属组</dt>
                        <dd>{{$role->guard_name}}</dd>
                        <dt>拥有权限</dt>
                        <dd>
                            @foreach($permissions as $permission)
                                @if($role->hasPermissionTo($permission->name))
                                    <span class="label label-default">{{$permission->name}}</span>
                                @endif
                            @endforeach
                        </dd>
                        <dt>创建时间</dt>
                        <dd>{{$role->created_at}}</dd>
                        <dt>更新日期</dt>
                        <dd>{{$role->updated_at}}</dd>

                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
@endsection