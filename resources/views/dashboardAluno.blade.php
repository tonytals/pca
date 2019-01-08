@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DASHBOARD</h2>
    </div>

      <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-teal hover-expand-effect">
                  <div class="icon">
                      <a href="{{ route('pacientes.index') }}">
                        <i class="material-icons">person</i>
                      </a>

                  </div>
                  <div class="content">
                      <div class="text">PACIENTES</div>
                      <div class="number count-to" data-from="0" data-to="{{$quantidade_pacientes}}" data-speed="1000" data-fresh-interval="20"></div>
                  </div>
              </div>

          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green hover-expand-effect">
                  <div class="icon">
                      <a href="#">
                        <i class="material-icons">forum</i>
                      </a>

                  </div>
                  <div class="content">
                      <div class="text">REGISTROS</div>
                      <div class="number count-to" data-from="0" data-to="{{$quantidade_comentarios}}" data-speed="1000" data-fresh-interval="20"></div>
                  </div>
              </div>

          </div>
      </div>

      <div class="row clearfix">
          <!-- Task Info -->
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <painel titulo='PRÓXIMAS VISITAS/ATENDIMENTOS'>
              <div class="table-responsive">
                  <table class="table table-hover dashboard-task-infos">
                      <thead>
                          <tr>
                              <th>Nome</th>
                              <th>Data do Agendamento</th>
                              <th>Atendimentos Realizados</th>
                              <th>Notificação</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($agenda as $item)
                          <tr>
                            <td>{{ $item->paciente_id }}</td>
                            <td>{{ Date::parse($item->data_inicio)->format('j \d\e F\, Y \- H:m') }}</td>
                            <td></td>
                            <td></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </painel>
          </div>
          <!-- #END# Task Info -->
          <!-- Browser Usage -->
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-teal">
                    <div class="font-bold m-b--35">N. de Atendimentos</div>
                      <ul class="dashboard-stat-list">
                        @foreach($locais_atendimento as $local)
                          @if($local[0]->local_atendimento != null)
                            <li>{{ $local[0]->local_atendimento }}
                              <span class="pull-right"><b>{{$local->count()}}</b> <small></small></span>
                            </li>
                          @endif
                        @endforeach
                    </ul>
                </div>
            </div>
          </div>
          <!-- #END# Browser Usage -->
      </div>

  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.countTo')
@stop

@section('scripts')
$(function () {
    $('.count-to').countTo();
  });
@stop
