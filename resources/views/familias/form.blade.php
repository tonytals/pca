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

      <painel titulo='ADICIONAR FAMÍLIA'>
        <formulario id="adicionaFamilia" method="post" action="{{ route('familias.store') }}" token="{{ csrf_token() }}">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="familia" placeholder="" value="{{ old('familia', $familia->familia ?? null) }}">
                      <label class="form-label">Sobrenome</label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-2">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" class="form-control cep" name="cep" placeholder="" value="{{ old('cep', $familia->cep ?? null) }}">
                      <label class="form-label">CEP</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" id="estado" class="form-control" name="estado" placeholder="" value="{{ old('estado', $familia->estado ?? null) }}">
                      <label class="form-label">Estado</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" id="cidade" class="form-control" name="cidade" placeholder="" value="{{ old('cidade', $familia->cidade ?? null) }}">
                      <label class="form-label">Cidade</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" id="endereco" class="form-control" name="endereco" placeholder="" value="{{ old('endereco', $familia->endereco ?? null) }}">
                      <label class="form-label">Endereço</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" id="numero" class="form-control" name="numero" placeholder="" value="{{ old('numero', $familia->numero ?? null) }}">
                      <label class="form-label">Número</label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="bairro" type="text" class="form-control" name="bairro" placeholder="" value="{{ old('bairro', $familia->bairro ?? null) }}">
                      <label class="form-label">Bairro</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="complemento" type="text" class="form-control" name="complemento" placeholder="" value="{{ old('complemento', $familia->complemento ?? null) }}">
                      <label class="form-label">Complemento</label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="telefone" type="text" class="form-control telefone" name="telefone" placeholder="" value="{{ old('telefone', $familia->telefone ?? null) }}">
                      <label class="form-label">Telefone</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="celular" type="text" class="form-control celular" name="celular" placeholder="" value="{{ old('celular', $familia->celular ?? null) }}">
                      <label class="form-label">Celular</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input id="renda_familiar" type="text" class="form-control dinheiro" name="renda_familiar" placeholder="" value="{{ old('renda_familiar', $familia->renda_familiar ?? null) }}">
                      <label class="form-label">Renda Familiar</label>
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
    $('#adicionaFamilia').validate({
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

$(".cep").focusout(function(){
		$.ajax({
			url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
			dataType: 'json',
			success: function(resposta){
				$("#endereco").val(resposta.logradouro).focus();
				$("#complemento").val(resposta.complemento).focus();
				$("#bairro").val(resposta.bairro).focus();
				$("#cidade").val(resposta.localidade).focus();
				$("#estado").val(resposta.uf).focus();
				$("#numero").parents('.form-line').addClass('error');
        $("#numero").addClass('error').focus();
			}
		});
});
@stop
