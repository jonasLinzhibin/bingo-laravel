@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <input type="text" class="form-control" placeholder="请输入关键字查询">
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" placeholder="请输入关键字查询">
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" placeholder="请输入关键字查询">
                        </div>
                        <div class="col-xs-2">
                            <input type="submit" class="btn btn-success" value="查询">
                        </div>
                    </div>
                </div>

                <!-- /.box-body -->
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">用户列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('users.create') }}" type="button" class="btn btn-block btn-info">添加用户</a>

                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>编号ID</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>状态</th>
                            <th>创建日期</th>
                            <th>更新日期</th>
                            <th>操作</th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['email']}}</td>
                                <td><span class="label label-success">状态</span></td>
                                <td>{{$item['created_at']}}</td>
                                <td>{{$item['updated_at']}}</td>
                                <td>
                                    <a href="{{route('users.show',$item)}}" class="btn btn-info">查看</a>
                                    <a href="{{route('users.edit',$item)}}" class="btn btn-info">修改</a>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('users.destroy',$item)}}" method="post">
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
