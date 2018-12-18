@extends('admin.layouts.default')

@section('style')
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.css') }}">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑菜单</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{route('menus.update',$data)}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="box-body fields-group">
                        <div class="form-group ">
                            <label class="col-sm-2  control-label">ID</label>
                            <div class="col-sm-8">
                                <div class="box box-solid box-default no-margin">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        {{$data['id']}}
                                    </div>
                                    <!-- /.box-body -->
                                </div>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parent_id" class="col-sm-2 control-label">父类菜单</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="parent_id">
                                <select class="form-control js-select2" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                    <option value="0">顶级菜单</option>
                                    @foreach($menus as $item)
                                        <option value="{{$item['id']}}">{{$item['title']}}</option>
                                        @if(!empty($item['child']))
                                            @foreach($item['child'] as $child)
                                                <option value="{{$child['id']}}">一一{{$child['title']}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="title" class="col-sm-2  control-label">标题</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="title" name="title" value="{{$data['title']}}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icon" class="col-sm-2  control-label">图标</label>
                            <div class="col-sm-8">
                                <div class="input-group iconpicker-container">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                    <input type="text" id="icon" name="icon" value="fa-bars" class="form-control js-iconpicker" placeholder="" style="width: 140px;">
                                </div>
                                <span class="help-block">
                                        <i class="fa fa-info-circle"></i>&nbsp;For more icons please see
                                        <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>
                                    </span>

                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="uri" class="col-sm-2  control-label">链接地址</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="uri" name="uri" value="{{old('uri')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group  ">
                            <label for="roles" class="col-sm-2  control-label">角色</label>
                            <div class="col-sm-8">
                                <select class="form-control js-select2 " name="roles[]" multiple="" data-placeholder="" data-value="" tabindex="-1" aria-hidden="true">
                                    @foreach($roles as $role)
                                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">提交</button>
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

@section('script')
    <script src="{{asset('bower_components/select2/dist/js/select2.js')}}"></script>
    <script>
        $(function () {


        });

    </script>

@endsection