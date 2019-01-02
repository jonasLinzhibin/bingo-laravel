@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">博文列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('posts.posts.create') }}" type="button" class="btn btn-block btn-info">添加博文</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><input type="checkbox" class="checkAll" > ID</th>
                            <th>文章标题</th>
                            <th>创建日期</th>
                            <th>更新日期</th>
                            <th>操作</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$post->id}}"> {{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->updated_at}}</td>
                                <td>
                                    {{--<a href="{{route('posts.posts.show',$post)}}"     class="btn btn-info">查看</a>--}}
                                    <a href="{{route('posts.posts.edit',$post)}}" class="btn btn-info">修改</a>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('posts.posts.destroy',$post)}}" method="post">
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
                    {{$posts->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
