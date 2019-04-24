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


        @if(isset($paciente))
            <painel titulo='ATUALIZAR PACIENTE'>
            <formulario id="adicionaPaciente" method="put" action="{{ route('pacientes.update', $paciente->id) }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
        @else
            <painel titulo='ADICIONAR PACIENTE'>
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
                    <input type="text" class="form-control email" name="email" value="{{ old('email', $paciente->email ?? null) }}">
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
                    <input required type="text" class="form-control" name="nome_mae" value="{{ old('nome_mae', $paciente->nome_mae ?? null) }}">
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
                  @if(isset($paciente))
                    <input type="text" class="form-control data" name="data_nascimento" placeholder="" value="{{ old('data_nascimento', Date::parse($paciente->data_nascimento)->format('d/m/Y') ?? null) }}">
                  @else
                    <input type="text" class="form-control data" name="data_nascimento" placeholder="" value="{{ old('data_nascimento', $paciente->data_nascimento ?? null) }}">
                  @endif
                    <label class="form-label">Data de Nascimento</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
              <div class="form-line">
                <select class="form-control show-tick" data-live-search="true" name="tipo_sanguineo_id">
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
          <div class="col-sm-4">
            <div class="demo-radio-button">Sexo:
                <input name="sexo" type="radio" value="F" class="with-gap" id="feminino"
                  @if(isset($paciente) && $paciente->getOriginal('sexo') == 'F') checked @endif
                >
                <label for="feminino">Feminino</label>

                <input name="sexo" type="radio" value="M" id="masculino" class="with-gap"
                  @if(isset($paciente) && $paciente->getOriginal('sexo') == 'M') checked @endif
                >
                <label for="masculino">Masculino</label>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="demo-checkbox">
                <input type="checkbox" value="1" id="alfabetizado" name="alfabetizado" @if(isset($paciente) && $paciente->alfabetizado != '') checked @endif class="filled-in chk-col-teal" />
                <label for="alfabetizado">Alfabetizado</label>
                <input type="checkbox" value="1" id="frequenta_escola" name="frequenta_escola" @if(isset($paciente) && $paciente->frequenta_escola != '') checked @endif class="filled-in chk-col-teal" />
                <label for="frequenta_escola">Frequenta Escola</label>
                <input type="checkbox" value="1" id="chefe_familia" name="chefe_familia" @if(isset($paciente) && $paciente->chefe_familia != '') checked @endif class="filled-in chk-col-teal" />
                <label for="chefe_familia">Chefe de Familia</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" list="religiao" class="form-control" name="religiao" placeholder="" value="{{ old('religiao', $paciente->religiao ?? null) }}">
                    <label class="form-label">Religião</label>
                    <datalist id="religiao">
                      <option>Não Possui</option>
                    </datalist>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="ocupacao" placeholder="" value="{{ old('ocupacao', $paciente->ocupacao ?? null) }}">
                    <label class="form-label">Ocupação</label>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-float">
              <div class="form-line">
                <select class="form-control show-tick" data-live-search="true" name="familia_id">
                  @if(!isset($paciente) || $paciente->getOriginal('familia_id') == null)
                    <option value="" >-- Familia ( Número SIAB ) --</option>
                  @endif
                  @foreach($familia as $valor)
                    @if(isset($paciente))
                      <option value="{{ $valor->id }}"
                        {{ $paciente['id'] == $valor->id ? 'selected' : '' }}
                        >{{$valor->familia . ' - ' . $valor->sobrenome}}</option>
                    @else
                      <option value="{{$valor->id}}">{{$valor->siab}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <div class="switch-title">Possui Plano de Saúde?</div>
            <div class="switch" style="bottom: -10px;position: relative;">
                <label>Não<input onclick="possuiPlano(this)" type="checkbox" id="possui_plano" name="possui_plano"><span class="lever switch-col-green"></span>Sim</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="form-group form-float">
                <div class="form-line">
                    <input disabled type="text" class="form-control" name="plano_saude" id="plano_saude" placeholder="" value="{{ old('plano_saude', $paciente->plano_saude ?? null) }}">
                    <label class="form-label">Plano de Saúde</label>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input list="procura_atendimento" type="text" class="form-control" name="procura_atendimento" placeholder="" value="{{ old('procura_atendimento', $paciente->procura_atendimento ?? null) }}">
                    <label class="form-label">Em Caso de Doença Procura?</label>
                </div>
                <datalist id="procura_atendimento">
                  <option>Hospital</option>
                  <option>Unidade de Saúde</option>
                  <option>Benzedeira</option>
                  <option>Farmácia</option>
                </datalist>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input list="grupo_comunitario" type="text" class="form-control" name="grupo_comunitario" placeholder="" value="{{ old('grupo_comunitario', $paciente->grupo_comunitario ?? null) }}">
                    <label class="form-label">Participa de Grupos Comunitários</label>
                </div>
                <datalist id="grupo_comunitario">
                  <option>Cooperativa</option>
                  <option>Grupo religioso</option>
                  <option>Associações</option>
                </datalist>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input list="meios_comunicacao" type="text" class="form-control" name="meios_comunicacao" placeholder="" value="{{ old('meios_comunicacao', $paciente->meios_comunicacao ?? null) }}">
                    <label class="form-label">Meios de Comunicação Utilizado</label>
                </div>
                <datalist id="meios_comunicacao">
                  <option>Celular</option>
                  <option>Internet</option>
                  <option>Telefonia</option>
                  <option>Rádio</option>
                  <option>Televisão</option>
                </datalist>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input list="meio_transporte" type="text" class="form-control" name="meio_transporte" placeholder="" value="{{ old('meio_transporte', $paciente->meio_transporte ?? null) }}">
                    <label class="form-label">Meio de Transporte</label>
                </div>
                <datalist id="meio_transporte">
                  <option>Ônibus</option>
                  <option>Caminhão</option>
                  <option>Carro</option>
                  <option>Carroça</option>
                </datalist>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <h5>Doenças e/ou Condições Referidas <small>Preennchimento Obrigatório</small></h5>
            <select name="doencasCondicoes[]" id="doencasCondicoes" class="ms" multiple="multiple">
              @foreach($condicoesReferidas as $valor)
                  @if(isset($paciente))
                    <option value="{{ $valor->id }}"
                      {{ array_search( $valor->id, array_column($paciente->condicoes_referidas->toArray(), 'id')) !== false ? 'selected' : '' }}
                      >{{$valor->sigla . ' - ' . $valor->nome}}</option>
                  @else
                    <option value="{{$valor->id}}">{{$valor->sigla . ' - ' . $valor->nome}}</option>
                  @endif
              @endforeach
            </select>
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
  @include('layouts.includes.multiSelect')
@stop

@section('scripts')
function possuiPlano(valor)
{
  if($('#possui_plano').prop("checked") == true){
    $('#plano_saude').prop('disabled',false);
  }
  else if($('#possui_plano').prop("checked") == false){
    $('#plano_saude').prop('disabled',true);
    $('#plano_saude').val('');
  }

}
$(function () {
    $('#doencasCondicoes').multiSelect({ selectableOptgroup: true });
    $('#adicionaPaciente').validate({
      rules : {
        doencasCondicoes:{
                    required:true
            },
      },
      messages:{
        doencasCondicoes:{
                  required: "Campo obrigatório"
            },
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

    @if(isset($paciente) || $errors->all())
        $('#adicionaPaciente').find('input').focus();
    @endif
});
@stop
