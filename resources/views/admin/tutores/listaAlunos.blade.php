@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='LISTA DE ALUNOS'>
        <modal-link titulo="Adicionar Grupo" css="btn bg-blue m-b-15" modal="adicionarUnidadeSaude"></modal-link>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable tabelaPreceptores">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome do Aluno</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Nome do Aluno</th>
                          <th>E-mail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach($alunos as $aluno)
                        <tr>
                          <td>{{$aluno->id}}</td>
                          <td><a href="{{route('tutor.aluno', $aluno->id)}}">{{$aluno->name}}</a></td>
                          <td>{{$aluno->email}}</td>
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
