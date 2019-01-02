@extends('admin.layouts.default')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/nestable/nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">

                <div class="box-header">

                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm tree-nestable-tree-tools" data-action="expand" title="Expand">
                            <i class="fa fa-plus-square-o"></i>&nbsp;展开
                        </a>
                        <a class="btn btn-primary btn-sm tree-nestable-tree-tools" data-action="collapse" title="Collapse">
                            <i class="fa fa-minus-square-o"></i>&nbsp;收起
                        </a>
                    </div>

                    <div class="btn-group">
                        <a class="btn btn-info btn-sm tree-nestable-save" title="Save" data-action="{{route('menus.sort')}}" ><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;保存</span></a>
                    </div>

                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;刷新</span></a>
                    </div>

                    <div class="btn-group">

                    </div>


                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="dd" id="tree-nestable">
                        <ol class="dd-list">

                            @foreach($menus as $item)
                            <li class="dd-item" data-id="{{$item['id']}}">

                                <div class="dd-handle">
                                    <i class="fa {{$item['icon']}}"></i>&nbsp;
                                    <strong>{{$item['title']}}</strong>&nbsp;&nbsp;&nbsp;
                                    <a href="{{$item['uri']}}" class="dd-nodrag">{{$item['uri']}}</a>
                                    <span class="pull-right dd-nodrag">
                                        <a href="{{route('menus.edit',['id'=>$item['id']])}}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" data-href="{{route('menus.del',['id'=>$item['id']])}}" class="ajax-confirm"><i class="fa fa-trash"></i></a>
                                    </span>
                                </div>

                                @if(!empty($item['child']))
                                <ol class="dd-list">
                                    @foreach($item['child'] as $child)
                                    <li class="dd-item" data-id="{{$child['id']}}">
                                        <div class="dd-handle">
                                            <i class="fa {{$child['icon']}}"></i>&nbsp;
                                            <strong>{{$child['title']}}</strong>&nbsp;&nbsp;&nbsp;
                                            <a href="{{$child['uri']}}" class="dd-nodrag">{{$child['uri']}}</a>
                                            <span class="pull-right dd-nodrag">
                                        <a href="{{route('menus.edit',['id'=>$child['id']])}}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" data-href="{{route('menus.del',['id'=>$child['id']])}}" class="ajax-confirm"><i class="fa fa-trash"></i></a>
                                    </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                                @endif

                            </li>
                            @endforeach

                        </ol>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6"><div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">添加</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                    <form method="POST" action="{{route('menus.store')}}" class="form-horizontal" accept-charset="UTF-8">

                        {{ csrf_field() }}
                        <div class="box-body fields-group">
                            <div class="form-group">
                                <label for="parent_id" class="col-sm-2 control-label">父类菜单</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="parent_id">
                                    <select class="form-control js-select2" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                        <option value="0">顶级菜单</option>
                                        @foreach($menus_list as $item)
                                        <option value="{{$item['id']}}">{{$item['tree_html']}}{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>

                            <div class="form-group  ">
                                <label for="title" class="col-sm-2 control-label">菜单名称</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2  control-label">图标</label>
                                <div class="col-sm-8">
                                    <div class="input-group iconpicker-container">
                                        <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                        <input type="text" id="icon" name="icon" value="fa-bars" class="form-control js-iconpicker" placeholder="">
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

                        </div>

                            <div class="col-md-2"></div>

                            <div class="col-md-8">
                                <div class="btn-group pull-left">
                                    <button type="reset" class="btn btn-warning pull-right">重置</button>
                                </div>
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-info pull-right">保存</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div></div>
    </div>
@endsection

@section('script')
    <script src="{{asset('plugins/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('bower_components/select2/dist/js/select2.js')}}"></script>
    <script>
        $(function () {

            $('#tree-nestable').nestable([]);

            $('.tree-nestable-tree-tools').on('click', function(e){
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('.tree-nestable-save').click(function () {
                var serialize = $('#tree-nestable').nestable('serialize');
                var param = {
                    _order: JSON.stringify(serialize)
                };
                postTo($(this).data('action'),param);
            });


        });

    </script>

@endsection