<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/23/2020
 * Time: 3:09 AM
 */
?>

<aside class="main-sidebar">
<?php $usuarioActual = Auth::user();?>
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/backend/img/author-default.png" class="img-circle" alt="{{$usuarioActual->name}}">
            </div>
            <div class="pull-left info">
                <p>{{$usuarioActual->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{url('/home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.blog.index')}}"><i class="fa fa-circle-o"></i> All Posts</a></li>
                    <li><a href="{{route('backend.blog.create')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            {{--so editor e admin têm permissao--}}
            {{-- @role(['admin','editor'])--}}
            @if(check_user_permissions(request(),"Categories@index"))
                <li><a href="{{route('backend.categories.index')}}"><i class="fa fa-folder"></i> <span>Categorias</span></a>
                </li>
            @endif
            {{--@endrole--}}

            {{--so admin tem permissao--}}
            {{--@role('admin')--}}
            @if(check_user_permissions(request(),"Users@index"))
                <li><a href="{{route('backend.users.index')}}"><i class="fa fa-users"></i> <span>Usuários</span></a>
                </li>
                {{--@endrole--}}
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
