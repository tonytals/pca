<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            @if(env('LOGO', 'logo') != '')
                <a class="navbar-brand" style="padding:0;margin-left:12px" href="{{route('dashboard')}}"><img src="{{ env('LOGO', 'logo') }}" style="max-height:100%"></a>
            @else
                <a class="navbar-brand" href="{{route('dashboard')}}">{{ config('app.name', 'prontuario eletronico') }}</a>
            @endif
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->
                <!-- Notificações -->
                <notificacoes></notificacoes>
                <!-- Notificações -->
                <!-- Tarefas -->
                <!--<tarefas></tarefas>
                 Tarefas
                <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                -->
            </ul>
        </div>
    </div>
</nav>
