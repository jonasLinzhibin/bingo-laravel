@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">修改资料</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{route('roles.update',$role)}}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">角色名称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$role->name}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">分配权限</label>

                            <div class="col-sm-10">
                                @foreach($permissions as $permission)
                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                           @if($role->hasPermissionTo($permission->name,$role->guard_name)) checked @endif
                                           id="{{$permission->id}}" >

                                    <label for="{{$permission->id}}">{{$permission->name}}</label>

                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection