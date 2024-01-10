@extends('layouts.backend.main')

@section('title','MyBlog | Editar conta')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Conta
                <small>Editar conta</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li class="active">Editar Conta</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                @include('backend.partials.message')
                {!!  Form::model($user,[
                            'method' => 'PUT',
                            'url' => '/update-account',
                            'id' => 'user-form'
                            ])!!}

                @include('backend.users.form',['hideRoleDropdown' => true,'hidePasswordFields' => true])

                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@include('backend.users.script')