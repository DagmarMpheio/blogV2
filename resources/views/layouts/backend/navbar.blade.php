<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/23/2020
 * Time: 3:06 AM
 */
?>
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>B</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MY</b>BLOG</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <?php $usuarioActual = Auth::user();?>
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/backend/img/author-default.png {{--{{$usuarioActual->gravatar()}}--}}"
                             class="user-image" alt="{{$usuarioActual->name}}">
                        <span class="hidden-xs">{{$usuarioActual->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/backend/img/author-default.png {{--{{$usuarioActual->gravatar()}}--}}"
                                 class="img-circle"
                                 alt="{{$usuarioActual->name}}">

                            <p>
                                {{$usuarioActual->name}} - {{$usuarioActual->roles->first()->display_name}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/edit-account')}}" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{__('Sair')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
