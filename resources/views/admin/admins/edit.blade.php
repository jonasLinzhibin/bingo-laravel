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
                <form action="{{route('admins.update',$admin)}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">所属角色</label>

                            <div class="col-sm-10">
                                @foreach($roles as $role)
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                           @if($admin->hasRole($role)) checked @endif
                                           id="{{$role->id}}" >

                                    <label for="{{$role->id}}">{{$role->name}} </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">昵称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$admin['name']}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">确认密码</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">头像</label>

                            <div class="col-sm-10">
{{--                                <img src="{{url($admin['avatar'])}}" class="img-lg img-thumbnail">--}}
                                <img src="{{url($admin->getFirstMediaUrl('avatar'))}}" class="img-lg img-thumbnail">

                                <input id="file" type="file" class="form-control" name="avatar">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">确定修改</button>
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