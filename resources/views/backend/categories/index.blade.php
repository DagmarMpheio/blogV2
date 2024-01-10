@extends('layouts.backend.main')

@section('title','MyBlog | Categories')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categorias
                <small>Listar todas as categorias </small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{route('backend.categories.index')}}">Categorias</a></li>
                <li class="active">Todas Categorias</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header clearfix">
                            <div class="pull-left">
                                <a href="{{route('backend.categories.create')}}" class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i> Nova Categoria</a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">

                            @include('backend.partials.message')

                            @if(!$categories->count())
                                <div class="alert alert-danger">
                                    <strong>Nenhuma Categoria Encotrada!</strong>
                                </div>
                            @else
                                @include('backend.categories.table')
                            @endif
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{$categories->appends( Request::query() )->links()}}
                            </div>

                            <div class="pull-right">
                                <small>{{$categoriesCount}} {{Str::Plural('Item',$categoriesCount)}}</small>
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