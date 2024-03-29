@extends('layouts.backend.main')

@section('title','MyBlog | Users')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Usuários
                <small>Listar todos os usuários</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{route('backend.users.index')}}">Usuários</a></li>
                <li class="active">Todos Usuários</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header clearfix">
                            <div class="pull-left">
                                <a href="{{route('backend.users.create')}}" class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i> Novo Usuário</a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">

                            @include('backend.partials.message')

                            @if(!$users->count())
                                <div class="alert alert-danger">
                                    <strong>Nenhum Usuário Encotrado!</strong>
                                </div>
                            @else
                                @include('backend.users.table')
                            @endif
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{$users->appends( Request::query() )->links()}}
                            </div>

                            <div class="pull-right">
                                <small>{{$usersCount}} {{Str::Plural('Item',$usersCount)}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>
@endsection