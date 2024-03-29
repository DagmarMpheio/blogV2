@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>My</b>BLOG</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Faça o login para iniciar a sessão</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group {{$errors->has('email') ? ' has-error': ''}} has-feedback">
                    <input type="email" class="form-control" name="email"
                           value="{{ old('email') }}" autocomplete="email" autofocus style="height: auto;"
                           placeholder="Email">
                    <span class="fa fa-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group {{$errors->has('password') ? ' has-error': ''}} has-feedback">
                    <input type="password" class="form-control" name="password"
                           autocomplete="current-password" placeholder="Password">
                    <span class="fa fa-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password')}}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}> Lembra-me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <br>
            <a href="{{ route('password.request') }}">Esqueci a minha senha</a><br>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
