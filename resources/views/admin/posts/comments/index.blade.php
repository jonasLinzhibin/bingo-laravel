@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">评论列表</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><input type="checkbox" class="checkAll" > ID</th>
                            <th>文章标题</th>
                            <th>评论内容</th>
                            <th>创建日期</th>
                            <th>操作</th>
                        </tr>
                        @foreach($comments as $comment)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{$comment->id}}">
                                    {{$comment->id}}</td>
                                <td>{{$comment->post['title']}}</td>
                                <td>{{$comment->content}}</td>
                                <td>{{$comment->created_at}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('posts.comments.destroy',$comment)}}" method="post">
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
                    {{$comments->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
