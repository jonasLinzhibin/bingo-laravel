@extends('admin.layouts.default')

@section('content')

     <!-- Info boxes -->
     <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                         <span class="info-box-text">管理员 </span>
                         <span class="info-box-number">{{$report['admins_num']}}</span>
                    </div>
                    <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                         <span class="info-box-text">文章</span>
                         <span class="info-box-number">{{$report['posts_num']}}</span>
                    </div>
                    <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                         <span class="info-box-text">商品</span>
                         <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                         <span class="info-box-text">会员</span>
                         <span class="info-box-number">{{$report['user_num']}}</span>
                    </div>
                    <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
          </div>
          <!-- /.col -->
     </div>
     <div class="row">
          <div class="col-md-6"><div class="box box-default">
                    <div class="box-header with-border">
                         <h3 class="box-title">系统信息</h3>

                         <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                         </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="table-responsive">
                              <table class="table table-striped">

                                   <tbody>

                                   @foreach($sysinfos as $sysinfo)
                                   @if($sysinfo['type']=='system')
                                   <tr>
                                        <td width="240px">{{$sysinfo['name']}}</td>
                                        <td><span class="label label-primary">{{$sysinfo['value']}}</span></td>
                                   </tr>
                                   @endif
                                   @endforeach
                                   </tbody></table>
                         </div>
                         <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
               </div></div>
          <div class="col-md-6"><div class="box box-default">
                    <div class="box-header with-border">
                         <h3 class="box-title">依赖支持</h3>

                         <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                         </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                         <div class="table-responsive">
                              <table class="table table-striped">
                                   <tbody>

                                   @foreach($sysinfos as $sysinfo)
                                        @if($sysinfo['type']=='dependencies')
                                             <tr>
                                                  <td width="240px">{{$sysinfo['name']}}</td>
                                                  <td><span class="label label-primary">{{$sysinfo['value']}}</span></td>
                                             </tr>
                                        @endif
                                   @endforeach
                                   </tbody></table>
                         </div>
                         <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
               </div></div>
     </div>

@endsection