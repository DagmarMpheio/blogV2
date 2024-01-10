@extends('layouts.backend.main')

@section('title','MyBlog | Add nova categoria')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categorias
                <small>Add nova categoria</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{route('backend.categories.index')}}">Categoria</a></li>
                <li class="active">Add nova</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!!  Form::model($category,[
                            'method' => 'POST',
                            'route' => 'backend.categories.store',
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