@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">

      @if ($errors->all())
        @foreach ($errors->all() as $key => $value)
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                {{ $value }}
            </div>
        @endforeach
      @endif

      <painel titulo='ADICIONAR PACIENTE'>
        @if(isset($paciente))
            <formulario id="adicionaPaciente" method="put" action="{{ route('pacientes.update', $paciente->id) }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
        @endif
        @if(!isset($paciente))
            <formulario id="adicionaPaciente" method="post" action="{{ route('pacientes.store') }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
        @endif
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input required type="text" class="form-control" name="nome_completo" placeholder="" value="{{ old('nome_completo', $paciente->nome_completo ?? null) }}">
                    <label class="form-label">Nome Completo</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input required type="text" class="form-control email" name="email" value="{{ old('email', $paciente->email ?? null) }}">
                    <label class="form-label">E-mail</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
              <div class="form-line required">
                <select class="form-control show-tick" data-live-search="true" name="estado_civil_id" required>
                  @if(!isset($paciente))
                    <option value>-- Estado Civil --</option>
                  @endif
                  @foreach($estadoCivil as $valor)
                    @if(isset($paciente))
                      <option value="{{ $valor->id }}"
                        {{ $paciente['estado_civil_id'] == $valor->id ? 'selected' : '' }}
                        >{{$valor->estado_civil}}</option>
                    @else
                      <option value="{{$valor->id}}">{{$valor->estado_civil}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="nome_pai" value="{{ old('nome_pai', $paciente->nome_pai ?? null) }}">
                    <label class="form-label">Nome do Pai</label>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="nome_mae" value="{{ old('nome_mae', $paciente->nome_mae ?? null) }}">
                    <label class="form-label">Nome da Mãe</label>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control cpf" name="cpf" placeholder="" value="{{ old('cpf', $paciente->cpf ?? null) }}">
                    <label class="form-label">CPF</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control rg-numero" name="rg" placeholder="" value="{{ old('rg', $paciente->rg ?? null) }}">
                    <label class="form-label">RG</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control date" name="data_nascimento" placeholder="" value="{{ old('data_nascimento',  Date::parse($paciente->data_nascimento)->format('d/m/Y') ?? null) }}">
                    <label class="form-label">Data de Nascimento</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
              <div class="form-line required">
                <select class="form-control show-tick" data-live-search="true" name="tipo_sanguineo_id" required>
                  @if(!isset($paciente))
                    <option value>-- Tipo Sanguíneo --</option>
                  @endif
                  @foreach($tipoSanguineo as $valor)
                    @if(isset($paciente))
                      <option value="{{ $valor->id }}"
                        {{ $paciente['tipo_sanguineo_id'] == $valor->id ? 'selected' : '' }}
                        >{{$valor->tipo_sanguineo}}</option>
                    @else
                      <option value="{{$valor->id}}">{{$valor->tipo_sanguineo}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-3">
            <div class="demo-radio-button">Sexo:
                <input name="sexo" type="radio" value="F" class="with-gap" id="feminino"
                  @if(isset($paciente) && $paciente->sexo == 'F') checked @endif
                >
                <label for="feminino">Feminino</label>

                <input name="sexo" type="radio" value="M" id="masculino" class="with-gap"
                  @if(isset($paciente) && $paciente->sexo == 'M') checked @endif
                >
                <label for="masculino">Masculino</label>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="demo-checkbox">
                <input type="checkbox" id="alfabetizado" name="alfabetizado" class="filled-in chk-col-teal" />
                <label for="alfabetizado">Alfabetizado</label>
                <input type="checkbox" id="frequenta_escola" name="frequenta_escola" class="filled-in chk-col-teal" />
                <label for="frequenta_escola">Frequenta Escola</label>
                <input type="checkbox" id="chefe_familia" name="chefe_familia" class="filled-in chk-col-teal" />
                <label for="chefe_familia">Chefe de Familia</label>
                <input type="checkbox" id="trabalha" name="trabalha" class="filled-in chk-col-teal" />
                <label for="trabalha">Trabalha</label>
                <input type="checkbox" id="gestante" name="gestante" class="filled-in chk-col-teal" />
                <label for="gestante">Gestante</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="religiao" placeholder="" value="{{ old('religiao', $paciente->religiao ?? null) }}">
                    <label class="form-label">Religião</label>
                </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group form-float">
              <div class="form-line">
                <select class="form-control show-tick" data-live-search="true" name="familia_id">
                  @if(!isset($paciente))
                    <option value>-- Familia --</option>
                  @endif
                  @foreach($familia as $valor)
                    @if(isset($paciente))
                      <option value="{{ $valor->id }}"
                        {{ $paciente['id'] == $valor->id ? 'selected' : '' }}
                        >{{$valor->familia}}</option>
                    @else
                      <option value="{{$valor->id}}">{{$valor->familia}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group form-float">
              <div class="form-line">
                <label for="foto">Foto do Paciente</label>
                <input type="file" id="foto" name="foto">
              </div>
            </div>
          </div>
        </div>
        <div class="align-right">
            <button class="btn btn-link waves-effect">SALVAR</button>
        </div>

      </formulario>
    </painel>
  </div>

</section>
@endsection

@section('includeJs')
  @include('layouts.includes.select')
  @include('layouts.includes.formValidator')
  @include('layouts.includes.inputMask')
@stop

@section('scripts')
$(function () {
    $('#adicionaPaciente').validate({
      rules : {

      },
      messages:{

      },
      highlight: function (input) {
          $(input).parents('.form-line').addClass('error');
      },
      unhighlight: function (input) {
          $(input).parents('.form-line').removeClass('error');
      },
      errorPlacement: function (error, element) {
          $(element).parents('.form-group').append(error);
      }
    });

    $('#adicionaPaciente').find('input[required]').css('border-bottom','solid thin red');
    $('.required').css('border-bottom','solid thin red');

    @if(isset($paciente))
        $('#adicionaPaciente').find('input').focus();
    @endif
});
@stop
