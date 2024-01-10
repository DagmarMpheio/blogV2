@extends('layouts.backend.main')

@section('title','MyBlog | Editar Categoria')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categorias
                <small>Editar categoria</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{route('backend.categories.index')}}">Categorias</a></li>
                <li class="active">Editar Categoria</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!!  Form::model($category,[
                            'method' => 'PUT',
                            'route' => ['backend.categories.update',$category->id],
                            'files' => true,
                            'id' => 'category-form'
                            ])!!}

                @include('backend.categories.form')

                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@include('backend.categories.script')