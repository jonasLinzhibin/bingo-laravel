@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">配置列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('config.create') }}" type="button" class="btn btn-block btn-info">添加配置</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>配置名</th>
                            <th>配置值</th>
                            <th>描述</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->key}}</td>
                                <td>{{$item->value}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    @if($item->status)
                                        <span class="label label-default">锁定</span>
                                    @else
                                        <span class="label label-success">正常</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('config.edit',$item)}}" class="btn btn-info">修改</a>

                                    @if($item->status)
                                    @else
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{route('config.destroy',$item)}}" method="post">
                                                {{csrf_field()}}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">删除</button>
                                            </form>
                                        </div>

                                    @endif

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
