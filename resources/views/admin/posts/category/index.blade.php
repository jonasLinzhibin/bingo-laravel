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
                        <a class="btn btn-info btn-sm tree-nestable-save" title="Save" data-action="{{route('posts.category.sort')}}" ><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;保存</span></a>
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

                            @foreach($categorys as $item)
                                <li class="dd-item" data-id="{{$item['id']}}">

                                    <div class="dd-handle">

                                        <i class="fa fa-bars"></i>&nbsp;
                                        <strong>{{$item['name']}} ( ID:{{$item['id']}} )</strong>&nbsp;&nbsp;&nbsp;
                                        {{--<a href="javascript:void(0)" class="dd-nodrag">{{$item['slug']}}</a>--}}

                                        @foreach($post_configs['data'] as $config)
                                            @if($config['id'] == $item['taxonomy'])
                                                <span class="label label-default">{{$config['post_type']}}</span>
                                            @endif
                                        @endforeach

                                        <span class="pull-right dd-nodrag">
                                        <a href="{{route('posts.category.edit',['id'=>$item['id']])}}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" data-href="{{route('posts.category.del',['id'=>$item['id']])}}" class="ajax-confirm"><i class="fa fa-trash"></i></a>
                                    </span>
                                    </div>

                                    @if(!empty($item['child']))
                                        <ol class="dd-list">
                                            @foreach($item['child'] as $child)
                                                <li class="dd-item" data-id="{{$child['id']}}">
                                                    <div class="dd-handle">

                                                        <i class="fa fa-bars"></i>&nbsp;
                                                        <strong>{{$child['name']}} ( ID:{{$child['id']}} )</strong>&nbsp;&nbsp;&nbsp;
                                                        {{--<a href="javascript:void(0)" class="dd-nodrag">{{$child['slug']}}</a>--}}

                                                        @foreach($post_configs['data'] as $config)
                                                            @if($config['id'] == $child['taxonomy'])
                                                                <span class="label label-default">{{$config['post_type']}}</span>
                                                            @endif
                                                        @endforeach


                                                        <span class="pull-right dd-nodrag">
                                        <a href="{{route('posts.category.edit',['id'=>$child['id']])}}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0);" data-href="{{route('posts.category.del',['id'=>$child['id']])}}" class="ajax-confirm"><i class="fa fa-trash"></i></a>
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
                    <h3 class="box-title">添加分类</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                    <form method="POST" action="{{route('posts.category.store')}}" class="form-horizontal" accept-charset="UTF-8">

                        {{ csrf_field() }}
                        <div class="box-body fields-group">
                            <div class="form-group">
                                <label for="parent_id" class="col-sm-2 control-label">父类</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="parent_id">
                                    <select class="form-control js-select2" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                        <option value="0">顶级</option>
                                        @foreach($categorys as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @if(!empty($item['child']))
                                                @foreach($item['child'] as $child)
                                                    <option value="{{$child['id']}}">一一{{$child['name']}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  ">
                                <label for="title" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2  control-label">分类别名</label>
                                <div class="col-sm-8">
                                    <input type="text" name="slug" value="{{old('slug')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2  control-label">分类类型</label>
                                <div class="col-sm-8">
                                    <select class="form-control js-select2" name="taxonomy" data-value="" tabindex="-1" aria-hidden="true"> 
                                        @foreach($post_configs['data'] as $config)
                                            <option value="{{$config['id']}}">{{$config['post_type']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2  control-label">SEO标题</label>
                                <div class="col-sm-8">
                                    <input type="text" name="seo_title" value="{{old('seo_title')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2  control-label">SEO关键字</label>
                                <div class="col-sm-8">
                                    <input type="text" name="seo_keywords" value="{{old('seo_keywords')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">描述（SEO）</label>
                                <div class="col-sm-8">
                                    <input type="text" name="seo_description" value="{{old('seo_description')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sort" value="{{old('sort',50)}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2  control-label">状态</label>
                                <div class="col-sm-8">
                                    <input type="radio" name="audit" value="1" checked>正常
                                    <input type="radio" name="audit" value="0" >禁用
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