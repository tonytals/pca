<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name', 'prontuario eletronico') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page theme-teal">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ config('app.name', 'prontuario eletronico') }}</b></a>
            <small>{{ config('app.nameAbreviado', 'pep') }} - 2018</small>
        </div>
        <div class="card">
            <div class="body">
              <form id="sign_in" method="POST" action="{{ route('login') }}">
                  @csrf

                    <div class="msg">
                      Entre com suas credênciais para iniciar

                      @if ($errors->has('email'))
                          <br />
                          <span class="font-bold col-red" role="alert">
                              {{ $errors->first('email') }}
                          </span>
                      @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>


                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Senha" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-teal">
                            <label for="rememberme">Lembrar-Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-block bg-teal waves-effect">
                                {{ __('ENTRAR') }}
                            </button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ route('register') }}">Registrar!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">Esqueceu Sua Senha?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- A DIV A SEGUIR EXISTE APENAS PARA EVITAR WARNING DO VUE.JS -->
    <div id="app"></div>


    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Bootstrap Core Js
    <script src="plugins/bootstrap/js/bootstrap.js"></script> -->

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js  -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>


    <script src="{{ asset('js/admin.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/sign-in.js') }}"></script>
</body>

</html>
