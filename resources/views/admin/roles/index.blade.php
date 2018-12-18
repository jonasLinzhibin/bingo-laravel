@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">角色列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('roles.create') }}" type="button" class="btn btn-block btn-info">添加角色</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>编号ID</th>
                            <th>角色</th>
                            <th>拥有权限</th>
                            <th>所属组</th>
                            <th>创建日期</th>
                            <th>更新日期</th>
                            <th>操作</th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @foreach($permissions as $permission)
                                        @if($item->hasPermissionTo($permission->name,$item->guard_name))
                                            <span class="label label-default">{{$permission->name}}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$item->guard_name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{route('roles.show',$item)}}" class="btn btn-info">查看</a>
                                    <a href="{{route('roles.edit',$item)}}" class="btn btn-info">修改</a>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('roles.destroy',$item)}}" method="post">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{$items->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
