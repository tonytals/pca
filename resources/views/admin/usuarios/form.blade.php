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

      @if(isset($usuario))
          <painel titulo='ATUALIZAR USUÁRIO'>
          <formulario id="adicionaUser" method="put" action="{{ route('usuarios.update', $usuario->id) }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
      @else
          <painel titulo='ADICIONAR USUÁRIO'>
          <formulario id="adicionaUser" method="post" action="{{ route('usuarios.store') }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
      @endif

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input required type="text" class="form-control" name="user" placeholder="" value="{{ old('user', $usuario->user ?? null) }}">
                    <label class="form-label">Usuário</label>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input required type="text" class="form-control email" name="email" value="{{ old('email', $usuario->email ?? null) }}">
                    <label class="form-label">E-mail</label>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="name" value="{{ old('name', $usuario->name ?? null) }}">
                    <label class="form-label">Nome Completo</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control cpf" name="cpf" placeholder="" value="{{ old('cpf', $usuario->cpf ?? null) }}">
                    <label class="form-label">CPF</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control rg-numero" name="rg" placeholder="" value="{{ old('rg', $usuario->rg ?? null) }}">
                    <label class="form-label">RG</label>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-2">
            <div class="form-group form-float">
                <div class="form-line">
                  @if(isset($usuario))
                    <input type="text" class="form-control data" name="data_nascimento" placeholder="" value="{{ old('data_nascimento', Date::parse($usuario->data_nascimento)->format('d/m/Y') ?? null) }}">
                  @else
                    <input type="text" class="form-control data" name="data_nascimento" placeholder="" value="{{ old('data_nascimento', $usuario->data_nascimento ?? null) }}">
                  @endif
                    <label class="form-label">Data de Nascimento</label>
                </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" data-live-search="true">
                      <option disabled selected value>-- Período --</option>
                      <option value="Matutino">Matutino</option>
                      <option value="Vespertino">Vespertino</option>
                      <option value="Noturno">Noturno</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control matricula" name="matricula" placeholder="" value="{{ old('matricula', $usuario->matricula ?? null) }}">
                    <label class="form-label">Matrícula</label>
                </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control turma" name="turma" placeholder="" value="{{ old('turma', $usuario->turma ?? null) }}">
                    <label class="form-label">Turma</label>
                </div>
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control ano" name="ano" placeholder="" value="{{ old('ano', $usuario->ano ?? null) }}">
                    <label class="form-label">Ano</label>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="demo-radio-button">Sexo:
                <input name="sexo" type="radio" value="F" class="with-gap" id="feminino"
                  @if(isset($usuario) && $usuario->sexo == 'F') checked @endif
                >
                <label for="feminino">Feminino</label>

                <input name="sexo" type="radio" value="M" id="masculino" class="with-gap"
                  @if(isset($usuario) && $usuario->sexo == 'M') checked @endif
                >
                <label for="masculino">Masculino</label>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="password" class="form-control" name="password" id="password" placeholder="" {{ !isset($usuario) ? 'required' : '' }} >
                      <label class="form-label">Senha</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" {{ !isset($usuario) ? 'required' : '' }}>
                      <label class="form-label">Confirmar Senha</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                <div class="form-line required">
                  <select class="form-control show-tick" data-live-search="true" name="papel_id" required>
                    @if(!isset($usuario))
                      <option value>-- Papel do Usuário --</option>
                    @endif
                    @foreach($papel as $valor)
                      @if(isset($usuario))
                        <option value="{{ $valor->id }}"
                          {{ $usuario->papeis[0]['papel_id'] == $valor->id ? 'selected' : '' }}
                          >{{$valor->nome}}</option>
                      @else
                        <option value="{{$valor->id}}">{{$valor->nome}}</option>
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
                <label for="foto">Foto do Perfil</label>
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
    $('#adicionaUser').validate({
      rules : {
            user:{
                    required:true
            },
            email:{
                   required:true,
                   email: true
            },
            @if(!isset($usuario))
              password:{
                     required:true
              },
              password_confirmation: {
                      required:true,
                      equalTo: "#password"
              },
            @endif
            papel_id: {
                    required:true
            }
      },
      messages:{
            user:{
                    required: "Campo obrigatório"
            },
            email:{
                   required: "É necessário informar um e-mail",
                   email: "Endereço de e-mail inválido"
            },
            @if(!isset($usuario))
              password:{
                     required: "Campo de preenchimento obrigatório"
              },
              password_confirmation:{
                    required: "Campo de preenchimento obrigatório",
                     equalTo: "As senhas devem ser identicas"
              },
            @endif
            papel_id:{
                   required: "Escolha um papel para o usuário"
            }
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
    $('#adicionaUser').find('input[required]').css('border-bottom','solid thin red');
    $('.required').css('border-bottom','solid thin red');

    @if(isset($usuario))
        $('#adicionaUser').find('input').focus();
    @endif
});
@stop
