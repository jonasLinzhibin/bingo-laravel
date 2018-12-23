@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">配置列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('setting.create') }}" type="button" class="btn btn-block btn-info">添加类型</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>前台发布审核</th>
                            <th>是否允许评论文档</th>
                            <th>文章类型</th>
                            <th>类型名称</th>
                            <th>操作</th>
                        </tr>
                        @foreach($configs as $config)
                            <tr>
                                <td>{{$config->id}}</td>
                                <td>
                                    @if($config->need_audit)
                                        需要
                                        @else
                                        不需要
                                    @endif
                                </td>
                                <td>
                                    @if($config->allow_comment)
                                        允许
                                    @else
                                        不允许
                                    @endif
                                </td>
                                <td>{{$config->post_type}}</td>
                                <td>{{$config->post_name}}</td>
                                <td>
                                    <a href="{{route('setting.edit',$config)}}" class="btn btn-info">修改</a>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('setting.destroy',$config)}}" method="post">
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
                    {{$configs->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
