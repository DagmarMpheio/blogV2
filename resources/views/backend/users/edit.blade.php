@extends('layouts.backend.main')

@section('title','MyBlog | Editar Usuário')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Usuários
                <small>Editar usuário</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{route('backend.users.index')}}">Usuários</a></li>
                <li class="active">Editar Usuário</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!!  Form::model($user,[
                            'method' => 'PUT',
                            'route' => ['backend.users.update',$user->id],
                            'id' => 'user-form'
                            ])!!}

                @include('backend.users.form')

                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@include('backend.users.script')