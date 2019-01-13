@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
    </div>

    <div class="row clearfix">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="header">

                  <h2>{{ $familia->familia }}</h2><small>Quantidade de Membros: {{ $familia->membros->count() }} </small>

              </div>
                <div class="body" id="prontuarioFamilia">
                  <div class="row clearfix">
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>Foto</th>
                                      <th>Nome</th>
                                      <th>Idade</th>
                                      <th>Sexo</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <th>Idade</th>
                                    <th>Sexo</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                @foreach($familia->membros as $membro)
                                  <tr>
                                    <td><img src="{{ $membro->foto }}" style="max-width:48px;"/></td>
                                    <td>{{ $membro->nome_completo }}</td>
                                    <td>{{ Date::parse($membro->data_nascimento)->age }}</td>
                                    <td>{{ $membro->sexo }}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>

                      <div class="image-area">

                      </div>
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
                        <li>
                          <br />
                          <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#adicionarRegistro">
                              <i class="material-icons">add</i>
                              <span>Adicionar Um Novo Registro</span>
                          </button>
                        </li>
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
                  @comments(['model' => $familia])
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
                  <h4 class="modal-title" id="adicionarAgendaLabel">Agendar Visita: {{ $familia->familia }}</h4>
              </div>
              <form method="POST" action="{{ route('agendamentos.store') }}">
                <div class="modal-body">
                  @csrf
                  <input type="hidden" name="paciente_id" value="{{ $familia->id }}">
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <div class="form-line">
                              <input type="text" class="datetimepicker form-control" name="data_inicio" id="data_inicio" placeholder="Selecione Data e Hora para a visita...">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <div class="form-group">
                          <div class="form-line">
                              <textarea rows="3" id="observacao" class="form-control no-resize" name="observacao" placeholder="Digite sua observação..."></textarea>
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
  @include('layouts.includes.datatables')
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
  });
  $('#baixarProntuario').click(function () {
    $('#botoes').hide();
    swal({
        title: "Aguarde",
        text: "Estamos criando seu PDF, pode levar alguns segundos =)",
        type: "warning"
      });
    html2canvas(document.querySelector("#prontuarioFamilia")).then(function(canvas) {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };
        doc.addImage(canvas, 'PNG', 10, 10, 190, 114);
        doc.save('thisMotion.pdf');
        $('#botoes').show();
        swal({
            title: "Tudo bem",
            text: "PDF gerado com sucesso",
            type: "success"
          });
    });
  });
@stop
