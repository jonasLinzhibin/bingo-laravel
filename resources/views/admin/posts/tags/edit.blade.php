@extends('admin.layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">修改</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('posts.tags.update',$tag) }}" method="post" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">

                        <div class="form-group">
                            <label class="control-label col-md-2" for="status">分类</label>
                            <div class="col-md-8">
                                <select name="category_id" class="form-control">
                                    @foreach($categorys as $item)
                                        <option value="{{$item['id']}}" @if($tag->id == $item['id']) selected @endif >{{$item['tree_html']}}{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">标签</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$tag->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">排序</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sort" value="{{$tag->sort}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection