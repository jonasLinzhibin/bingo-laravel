@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">标签列表</h3>

                    <div class="box-tools ">
                        <div class="input-group input-group-lg" style="width: 150px;">
                            <a href="{{ route('posts.tags.create') }}" type="button" class="btn btn-block btn-info">添加标签</a>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><input type="checkbox" class="checkAll" > ID</th>
                            <th>分类</th>
                            <th>标签</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($tags as $tag)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$tag->id}}"> {{$tag->id}}</td>
                                <td>

                                    @foreach($categorys as $category)
                                       @if($tag->category_id == $category->id) {{$category['name']}} @endif
                                    @endforeach
                                </td>
                                <td>{{$tag->name}}</td>
                                <td>
                                    @if($tag->status)
                                        正常
                                    @else
                                        禁用
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('posts.tags.edit',$tag)}}" class="btn btn-info">修改</a>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{route('posts.tags.destroy',$tag)}}" method="post">
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
                    {{$tags->links()}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
