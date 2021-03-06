@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='PRECEPTORES'>
        <modal-link titulo="Adicionar Unidade de Saúde" css="btn bg-blue m-b-15" modal="adicionarUnidadeSaude"></modal-link>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable tabelaPreceptores">
                    <thead>
                        <tr>
                            <th>Responsável</th>
                            <th>Unidade de Saúde</th>
                            <th>Quantidade de Alunos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>Responsável</th>
                          <th>Unidade de Saúde</th>
                          <th>Quantidade de Alunos</th>
                          <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach($preceptores as $preceptor)
                        <tr>
                          <td>{{ $preceptor->name }}</td>
                          <td>{{ $preceptor->groups->first()['name'] }}</td>
                          <td>{{ $preceptor->groups->first()->users->count() > 0 ? $preceptor->groups->first()->users->count() - 1 : 0 }}</td>
                          <td>
                            @if($preceptor->groups->first()['name'] == null)
                              <a class="btn bg-blue waves-effect" href="">
                                  <i class="material-icons">add</i>
                                  <span>Criar Unidade de Saúde</span>
                              </a>
                            @else
                              <a class="btn bg-purple waves-effect" href="{{route('grupos.show',$preceptor->groups->first()['user_id'])}}">
                                  <i class="material-icons">group_add</i>
                                  <span>Gerenciar Unidade de Saúde</span>
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
                    <label class="form-label">Nome da Unidade</label>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-float">
              <div class="form-line required">
                <select class="form-control show-tick" data-live-search="true" name="user_id" required>
                    <option value>-- Responsável Pela Unidade --</option>
                  @foreach($preceptores as $preceptor)
                      @if($preceptor->groups->first()['name'] == null)
                        <option value="{{$preceptor->id}}">{{$preceptor->name}}</option>
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

    responsive: true,

    language: {
            "url": "/plugins/jquery-datatable/lang/pt/Portuguese-Brasil.json"
        },
});
@stop
