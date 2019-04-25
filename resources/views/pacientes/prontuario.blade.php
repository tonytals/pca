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
                  @if(is_numeric($paciente->getOriginal('familia_id')))
                  <small>
                    <a href="{{ route('familias.show', $paciente->getOriginal('familia_id') )}}">
                      {{ $paciente->familia_id }}
                    </a>
                  </small>
                  @endif
                </div>
                <div class="body" id="prontuarioPaciente">
                  <div class="row clearfix">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="fotoPaciente">
                      <div class="image-area">
                          <img src="{{ $paciente->foto }}" style="max-width:100%" alt="{{$paciente->nome_completo}}" class="img-thumbnail">
                      </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" id="dadosPaciente">
                      <span class="font-bold align-center col-cyan">{{$paciente->alfabetizado}}</span>
                      <span class="font-bold align-center col-cyan">{{$paciente->frequenta_escola}}</span>
                      <span class="font-bold align-center col-cyan">{{$paciente->chefe_familia}}</span>
                      <ul class="list-unstyled">
                        <li><b>Data de Nascimento:</b> {{ Date::parse($paciente->data_nascimento)->format('j \d\e F\, Y') . ' ('. Date::parse($paciente->data_nascimento)->age .' anos)' }} </li>
                        <li><b>CPF:</b> <span>{{ mascara("###.###.###-##", $paciente->cpf) }}</span></li>
                        <li><b>RG:</b> {{ $paciente->rg }}</li>
                        <li><b>Estado Civil:</b> {{ $paciente->estado_civil['estado_civil'] }}</li>
                        <li><b>Tipo Sanguineo:</b> {{ $paciente->tipo_sanguineo_id }}</li>
                        <li><b>E-mail:</b> {{ $paciente->email }}</li>
                        <li><b>Nome do Pai:</b> {{ $paciente->nome_pai }}</li>
                        <li><b>Nome da Mãe:</b> {{ $paciente->nome_mae }}</li>
                        <li><b>Sexo:</b> {{ $paciente->sexo }}</li>
                        <li><b>Religião:</b> {{ $paciente->religiao }}</li>
                        <li><b>Ocupação:</b> {{ $paciente->ocupacao }}</li>
                        <li><b>Condições Referidas:</b><br/>
                          @foreach($paciente->condicoes_referidas as $valor)
                            <span class="label bg-grey">{{$valor->sigla . ' - ' . $valor->nome}}</span>
                          @endforeach
                        </li>
                      </ul>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <ul class="list-unstyled" id="botoes">
                        <li>
                          <br />
                          <button type="button" id="baixarProntuario" class="btn btn-success btn-block btn-lg waves-effect">
                              <i class="material-icons">file_download</i>
                              <span>Baixar Prontuário</span>
                          </button>
                        </li>
                        @can('pacientes-create')
                          <li>
                            <br />
                            <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#adicionarRegistro">
                                <i class="material-icons">add</i>
                                <span>Adicionar Um Novo Registro</span>
                            </button>
                          </li>
                          @endcan
                        <li>
                          <br />
                          <button type="button" class="btn bg-green btn-block btn-lg waves-effect" data-toggle="modal" data-target="#adicionarAgenda">
                              <i class="material-icons">date_range</i>
                              <span>Agendar Visita</span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                <div class="row clearfix">
                  @comments(['model' => $paciente])
                  @endcomments
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="adicionarAgenda" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="adicionarAgendaLabel">Agendar Visita: {{ $paciente->nome_completo }}</h4>
              </div>
              <form method="POST" action="{{ route('agendamentos.store') }}">
                <div class="modal-body">
                  @csrf
                  <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <div class="form-line">
                              <input required type="text" class="datetimepicker form-control" name="data_inicio" id="data_inicio" placeholder="Selecione Data e Hora para a visita...">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <div class="form-group">
                          <div class="form-line">
                              <textarea required rows="3" id="observacao" class="form-control no-resize" name="observacao" placeholder="Digite sua observação..."></textarea>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
                </div>
              </form>
          </div>
      </div>
  </div>

</section>
@endsection

@section('includeJs')
  @include('layouts.includes.inputMask')
  @include('layouts.includes.select')
  @include('layouts.includes.modals')
  @include('layouts.includes.summernote')
  @include('layouts.includes.datetimepicker')
  @include('layouts.includes.dialogs')
  @include('layouts.includes.pdf')
@stop

@section('scripts')
$(function () {
    $('.summernote').summernote({
      tabsize: 2,
      lang: 'pt-BR',
      height: 180
    });
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY HH:mm',
        weekStart: 0,
        lang: 'pt-BR',
        time: true,
    });

    $('#novoRegistro').find('input[required]').css('border-bottom','solid thin red');
    $('.required').css('border-bottom','solid thin red');

    @if(isset($paciente))
        $('#adicionaPaciente').find('input').focus();
    @endif

  });
  $('#baixarProntuario').click(function () {
    $('#botoes').hide();
    swal({
        title: "Aguarde",
        text: "Estamos criando seu PDF, pode levar alguns segundos =)",
        type: "warning"
      });
    html2canvas(document.querySelector("#prontuarioPaciente")).then(function(canvas) {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };
        doc.addImage(canvas, 'PNG', 10, 10, 190, 114);
        doc.save('prontuario.pdf');
        $('#botoes').show();
        swal({
            title: "Tudo bem",
            text: "PDF gerado com sucesso",
            type: "success"
          });
    });
  });
@stop
