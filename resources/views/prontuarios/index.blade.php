@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>PORTFÓLIO CLÍNICO</h2>
    </div>


    <div class="row clearfix">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="header">

                  <h2>{{ $paciente->nome_completo }}</h2>

              </div>
                <div class="body">
                  <div class="row clearfix">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <img src="https://cdn2.iconfinder.com/data/icons/lil-faces/226/lil-face-14-512.png" style="max-width:100%" alt="..." class="img-thumbnail">
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <ul class="list-unstyled">
                        <li><b>Data de Nascimento:</b> {{ $paciente->data_nascimento }} </li>
                        <li><b>CPF:</b> <span class="cpf">{{ $paciente->cpf }}</span></li>
                        <li><b>RG:</b> {{ $paciente->rg }}</li>
                        <li><b>Estado Civil:</b> {{ $paciente->estado_civil['estado_civil'] }}</li>
                        <li><b>Tipo Sanguineo:</b> {{ $paciente->tipo_sanguineo['tipo_sanguineo'] }}</li>
                        <li><b>E-mail:</b> {{ $paciente->email }}</li>
                        <li><b>Nome do Pai:</b> {{ $paciente->nome_pai }}</li>
                        <li><b>Nome da Mãe:</b> {{ $paciente->nome_mae }}</li>
                        <li><b>Sexo:</b> {{ $paciente->sexo }}</li>
                        <li><b>Religião:</b> {{ $paciente->religiao }}</li>
                      </ul>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <ul class="list-unstyled">
                        <li>
                          <button type="button" class="btn btn-primary btn-block btn-lg waves-effect">
                              <i class="material-icons">print</i>
                              <span>Imprimir</span>
                          </button>
                        </li>
                        <li>
                          <br />
                          <button type="button" class="btn btn-success btn-block btn-lg waves-effect">
                              <i class="material-icons">file_download</i>
                              <span>Baixar Prontuário</span>
                          </button>
                        </li>
                        <li>
                          <br />
                          <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#adicionarRegistro">
                              <i class="material-icons">add</i>
                              <span>Adicionar Um Novo Registro</span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                <div class="row clearfix">
                  @comments(['model' => $prontuarios])
                  @endcomments
                </div>
            </div>
        </div>
      </div>
    </div>


  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.inputMask')
  @include('layouts.includes.select')
  @include('layouts.includes.modals')
@stop

@section('scripts')
  $("span.cpf").inputmask("999.999.999-99");
@stop
