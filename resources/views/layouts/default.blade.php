<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name', 'prontuario eletronico') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
                        'csrfToken' => csrf_token(),
                        'userPapeis' => Auth::user()->papeis,
                        'permissoes' => Auth::user()->getMinhasPermissoes->pluck('permissoes')
                    ]); ?>
    </script>
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

    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @routes
</head>

<body class="theme-teal">
  <!-- preloader de página -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-teal">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Um instante...</p>
        </div>
    </div>
  <!-- ##fim do preloader de página -->
  <!-- Overlay -->
  <div class="overlay"></div>
  <!-- #fim Overlay -->

  <div id="app">
    @include('layouts.partials.barraPesquisa')
    @include('layouts.partials.barraTopo')
    <section>
      <aside id="leftsidebar" class="sidebar">
        @include('layouts.partials.informacoesUsuario')
        <menu-principal></menu-principal>
        <div class="legal">
          <div class="copyright">
            © 2018 <a href="javascript:void(0);">{{ config('app.name', 'prontuario eletronico') }}</a>.
          </div>
          <div class="version"><b>Versão: </b> @version('compact')</div><br />
        </div>
      </aside>
    </section>
    @if($errors->any())
        <section class="content">
            <h4>{{$errors->first()}}</h4>
        </section>
    @endif

    @yield('content')

  </div>

  <!--
  ## JQUERY COMPILADO
  -->
  <script src="{{ asset('js/app.js') }}"></script>

  <script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('plugins/notifications.js') }}"></script>
  <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

  <script src="{{ asset('js/admin.js') }}"></script>
  @if(session()->has('info'))
    <script type="text/javascript">
        $(function () {
          $.notify({
              message: 'Sem permissão para acessar esse paciente!'
          }, {
            allow_dismiss: true,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: 'bottom',
                align: 'right'
            },
          	animate: {
          		enter: 'animated fadeInDown',
          		exit: 'animated fadeOutUp'
          	},
            template:
              '<div class="alert bg-red alert-dismissible col-sm-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Sem permissão para acessar!</strong></div>'
          });
        });
    </script>
  @endif
  @if(session()->has('sucesso'))
    <script type="text/javascript">
        $(function () {
          $.notify({
              message: 'Criado Com Sucesso!'
          }, {
            allow_dismiss: true,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: 'bottom',
                align: 'right'
            },
          	animate: {
          		enter: 'animated fadeInDown',
          		exit: 'animated fadeOutUp'
          	},
            template:
              '<div class="alert bg-green alert-dismissible col-sm-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Criado Com Sucesso!</strong></div>'
          });
        });
    </script>
  @endif

  @yield('includeJs')

  <script type="text/javascript">
      @yield ('scripts')
  </script>

  @yield('beforeCloseBody')

</body>
</html>
