@extends('admin.layouts.default')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/css/site.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a class="foo" href="#" data-name="John">右键点击这里</a>   文件列表 {{$folder}} </h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>修改日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="filesBody" class="list-list">
                        @foreach($directories as $directory)
                            <tr class="folderBoxTr" data-path="{{$directory['realFolder']}}" filetype="{{$directory['filetype']}}">
                                <td>
                                    @if($directory['filetype'] == 'dir')
                                        <a class="btlink" href="{{route('medias.index',['folder'=>$directory['realFolder']])}}">
                                            <span class="ico ico-folder"></span>
                                            {{$directory['name']}}</a>
                                    @else

                                        <span class="ico ico-file"></span>
                                        {{$directory['name']}}
                                    @endif
                                </td>
                                <td>{{$directory['size']}}</td>
                                <td>{{$directory['lastModified']}}</td>
                                <td>


                                    <span>
                                        <a class="btlink" href="javascript:;" onclick="CopyFile('//dump.rdb')">复制</a> |
                                        <a class="btlink" href="javascript:;" onclick="CutFile('//dump.rdb')">剪切</a> |
                                        <a class="btlink" href="javascript:;" onclick="ReName(0,'{{$directory["name"]}}')">重命名</a> |

                                        <a class="btlink" href="javascript:;" onclick="OnlineEditFile(0,'//dump.rdb')">编辑</a> |
                                        <a class="btlink" href="javascript:;" onclick="GetFileBytes('//dump.rdb',92)">下载</a> |
                                        <a class="btlink" href="javascript:;" onclick="DeleteFile('//dump.rdb')">删除</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection

@section('modal')
    @parent
    <ul id="rmenu" class="dropdown-menu" style="display:none">
        <li onclick="javascript:Batch(1);"><a style="cursor: pointer;">复制</a></li>
        <li onclick="javascript:Batch(2);"><a style="cursor: pointer;">剪切</a></li>
        <li onclick="javascript:Batch(5);"><a style="cursor: pointer;">压缩</a></li>
        <li onclick="javascript:Batch(3);"><a style="cursor: pointer;">权限</a></li>
        <li onclick="javascript:Batch(4);"><a style="cursor: pointer;">删除</a></li>
    </ul>
@endsection

@section('script')
    @parent
    <script src="{{asset('bower_components/jquery-contextify/dist/jquery.contextify.js')}}"></script>
    <script src="{{asset('admin/js/lan.js')}}"></script>
    <script src="{{asset('admin/js/files.js')}}"></script>
@endsection