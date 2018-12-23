@extends('admin.layouts.default')

@section('content')
     <div class="row">
          <div class="col-md-6"><div class="box box-default">
                    <div class="box-header with-border">
                         <h3 class="box-title">Environment</h3>

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

                                   <tbody><tr>
                                        <td width="120px">PHP version</td>
                                        <td>PHP/7.0.30</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Laravel version</td>
                                        <td>5.5.44</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">CGI</td>
                                        <td>cgi-fcgi</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Uname</td>
                                        <td>Windows NT WIN-7 10.0 build 17134 (Windows 10) AMD64</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Server</td>
                                        <td>nginx/1.14.0</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Cache driver</td>
                                        <td>file</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Session driver</td>
                                        <td>file</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Queue driver</td>
                                        <td>sync</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Timezone</td>
                                        <td>UTC</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Locale</td>
                                        <td>en</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">Env</td>
                                        <td>local</td>
                                   </tr>
                                   <tr>
                                        <td width="120px">URL</td>
                                        <td>http://laravel-admin.com</td>
                                   </tr>
                                   </tbody></table>
                         </div>
                         <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
               </div></div>
          <div class="col-md-6"><div class="box box-default">
                    <div class="box-header with-border">
                         <h3 class="box-title">Dependencies</h3>

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
                                   <tbody><tr>
                                        <td width="240px">php</td>
                                        <td><span class="label label-primary">&gt;=7.0.0</span></td>
                                   </tr>
                                   <tr>
                                        <td width="240px">encore/laravel-admin</td>
                                        <td><span class="label label-primary">^1.6</span></td>
                                   </tr>
                                   <tr>
                                        <td width="240px">fideloper/proxy</td>
                                        <td><span class="label label-primary">~3.3</span></td>
                                   </tr>
                                   <tr>
                                        <td width="240px">laravel/framework</td>
                                        <td><span class="label label-primary">5.5.*</span></td>
                                   </tr>
                                   <tr>
                                        <td width="240px">laravel/tinker</td>
                                        <td><span class="label label-primary">~1.0</span></td>
                                   </tr>
                                   </tbody></table>
                         </div>
                         <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
               </div></div>
     </div>

@endsection