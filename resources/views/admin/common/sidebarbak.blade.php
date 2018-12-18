<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar admins panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->guard('admin')->user()->getFirstMediaUrl('avatar')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @if(auth()->guard('admin')->check())
                    <p>{{ auth()->guard('admin')->user()->name }}</p>
                @endif
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">菜单</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href=""><i class="fa fa-link"></i> <span>控制面板</span></a></li>

            <li class="treeview">
                <a href="{{route('admins.index')}}"><i class="fa fa-link"></i> <span>管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admins.index')}}">用户</a></li>
                    <li><a href="{{route('roles.index')}}">角色</a></li>
                    <li><a href="{{route('permissions.index')}}">权限</a></li>
                    <li><a href="{{route('menus.index')}}">菜单</a></li>
                    <li><a href="{{route('users.index')}}">会员</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{route('medias.index')}}"><i class="fa fa-link"></i> <span>文件管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('medias.index')}}">文件列表</a></li>
                    <li><a href="{{route('medias.create')}}">添加文件</a></li>
                </ul>


            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>