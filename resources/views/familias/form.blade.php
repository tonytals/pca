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


      @if(isset($familia))
          <painel titulo='ATUALIZAR FAMÍLIA'>
            <formulario id="adicionaFamilia" method="post" action="{{ route('familias.update', $familia->id) }}" token="{{ csrf_token() }}">
      @else
          <painel titulo='ADICIONAR FAMÍLIA'>
            <formulario id="adicionaFamilia" method="post" action="{{ route('familias.store') }}" token="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
      @endif
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="familia" placeholder="" value="{{ old('familia', $familia->familia ?? null) }}">
                      <label class="form-label">Familia</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="segmento" placeholder="" value="{{ old('segmento', $familia->segmento ?? null) }}">
                      <label class="form-label">Segmento</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="area" placeholder="" value="{{ old('area', $familia->area ?? null) }}">
                      <label class="form-label">Área</label>
                  </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="microarea" placeholder="" value="{{ old('microarea', $familia->microarea ?? null) }}">
                      <label class="form-label">Microárea</label>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input required type="text" class="form-control" name="sobrenome" placeholder="" value="{{ old('sobrenome', $familia->sobrenome ?? null) }}">
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

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group form-float">
                <div class="form-line">
                  <div class="form-line">
                      <input list="tipos-de-casa" id="tipo_casa" type="text" class="form-control" name="tipo_casa" placeholder="" value="{{ old('tipo_casa', $familia->tipo_casa ?? null) }}">
                      <label class="form-label">Tipo de Casa</label>
                  </div>
                  <datalist id="tipos-de-casa">
                    <option>Tijolo/Adobe</option>
                    <option>Taipa Revestida</option>
                    <option>Taipa Não Revestida</option>
                    <option>Madeira</option>
                    <option>Material Aproveitado</option>
                  </datalist>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 text-center">
                  <div class="switch-title">No. de Cômodos / Peças</div>
                  <div class="input-group spinner" data-trigger="spinner">
                      <div class="form-line">
                          <input type="text" id="numero_comodos" name="numero_comodos" class="form-control text-center" value="1" data-rule="quantity">
                      </div>
                      <span class="input-group-addon">
                          <a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
                          <a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
                      </span>
                  </div>
                </div>
                <div class="col-sm-6 text-center">
                  <div class="switch-title">Energia Elétrica</div>
                  <div class="switch" style="bottom: -10px;position: relative;">
                      <label>Não<input type="checkbox" id="energia_eletrica" name="energia_eletrica" checked><span class="lever switch-col-green"></span>Sim</label>
                  </div>
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
  @include('layouts.includes.spinner')
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
$('#estado_civil_id').on('keydown', function (e, clickedIndex, isSelected, previousValue) {
  console.log(e);
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
