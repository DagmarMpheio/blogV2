<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/23/2020
 * Time: 2:44 AM
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyBlog | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/backend/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/v4-shims.min.css')}}">{{--redes sociais--}}
<!-- Ionicons -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">--}}
    <link rel="stylesheet" href="{{asset('/backend/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/backend/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    {{--<link rel="stylesheet" href="/backend/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">--}}
    {{-- estilo para markdown--}}
    <link rel="stylesheet" href="/backend/plugins/simplemde/simplemde.min.css">
    {{--custom css--}}
    <link rel="stylesheet" href="/backend/css/custom.css">
    {{-- bootstrap-datetimepicker css--}}
    <link rel="stylesheet" href="/backend/css/bootstrap-datetimepicker.min.css">
    {{--jasny-boostrap--}}
    <link rel="stylesheet" href="/backend/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css">
    @yield('style')


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <script src="/backend/js/html5shiv.min.js"></script>
    <script src="/backend/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('layouts.backend.navbar')

<!-- Left side column. contains the logo and sidebar -->
    @include('layouts.backend.sidebar')
    {{--conteudo da pagina--}}
    @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.6
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/backend/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/backend/js/bootstrap.min.js"></script>
<script src="/backend/plugins/simplemde/simplemde.min.js"></script>
{{--moment js--}}
<script src="/backend/js/moment-with-locales.min.js"></script>
{{--bootstrap timepicker--}}
<script src="/backend/js/bootstrap-datetimepicker.min.js"></script>
{{--jasny-bootstrap--}}
<script src="/backend/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/backend/js/app.min.js"></script>
@yield('script')
</body>
</html>

