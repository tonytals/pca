@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='UNIDADES DE SAÚDE'>
        <a class="btn bg-blue m-b-15" href="{{ route('unidadesdesaude.create') }}">Adiciona Unidade De Saúde</a>
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
                          <td>{{ $preceptor->groups->count() > 0 ? $preceptor->groups->count() - 1 : 0 }}</td>
                          <td>
                            @if($preceptor->groups->first()['name'] == null)
                              <a class="btn bg-blue waves-effect" href="{{ route('unidadesdesaude.create') }}">
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
