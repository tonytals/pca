@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='PRECEPTORES'>
        <modal-link titulo="Adicionar Grupo" css="btn bg-blue m-b-15" modal="adicionarUnidadeSaude"></modal-link>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable tabelaPreceptores">
                    <thead>
                        <tr>
                            <th>Responsável</th>
                            <th>Unidade de Saúde</th>
                            <th>Quantidade de Preceptores</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>Responsável</th>
                          <th>Unidade de Saúde</th>
                          <th>Quantidade de Preceptores</th>
                          <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach($tutores as $tutor)
                        <tr>
                          <td>{{ $tutor->name }}</td>
                          <td>{{ $tutor->groups->first()['name'] }}</td>
                          <td>{{ $tutor->groups->first()->users->count() > 0 ? $tutor->groups->first()->users->count() - 1 : 0 }}</td>
                          <td>
                            @if($tutor->groups->first()['name'] == null)

                                  <span>Tutor sem grupo</span>

                            @else
                              <a class="btn bg-purple waves-effect" href="{{route('grupos.showPreceptores',$tutor->groups->first()['user_id'])}}">
                                  <i class="material-icons">group_add</i>
                                  <span>Gerenciar Grupo</span>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </painel>
		</div>
  </div>

  <modal titulo="Adicionar Unidade de Saúde" modal="adicionarUnidadeSaude">
    <form method="POST" action="{{ route('grupos.store') }}">
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="name" placeholder="">
                    <label class="form-label">Nome do Grupo</label>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-float">
              <div class="form-line required">
                <select class="form-control show-tick" data-live-search="true" name="user_id" required>
                    <option value>-- Responsável Pela Unidade --</option>
                  @foreach($tutores as $tutor)
                      @if($tutor->groups->first()['name'] == null)
                        <option value="{{$tutor->id}}">{{$tutor->name}}</option>
                      @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
                <div class="form-line">
                    <textarea rows="4" class="form-control no-resize" name="description" placeholder="Por favor digite a sua observação..."></textarea>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
        </div>
    </form>
  </modal>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.select')
  @include('layouts.includes.datatables')
@stop

@section('scripts')
$('.tabelaPreceptores').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        {
            text: 'Excel',
            className: 'btn bg-teal waves-effect',
            extend: 'excel'
        },
        {
            text: 'PDF',
            className: 'btn bg-green waves-effect',
            extend: 'pdf'
        },
    ],
    language: {
            "url": "/plugins/jquery-datatable/lang/pt/Portuguese-Brasil.json"
        },
});
@stop
