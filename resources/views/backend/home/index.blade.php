@extends('layouts.backend.main')

@section('title','MyBlog | Dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body ">
                            <h3>Bem Vindo ao MyBlog!</h3>
                            <p class="lead text-muted">Olá <strong>{{Auth::user()->name}}</strong>, Bem Vindo ao MyBlog
                            </p>

                            <h4>Vamos Começar</h4>
                            <p><a href="{{route('backend.blog.create')}}" class="btn btn-primary">Escreva o teu primeiro
                                    blog</a></p>
                        </div>
                        <!-- /.box-body -->
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
