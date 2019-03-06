@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='FAMÍLIAS CADASTRADAS'>
        <a href="{{ route('familias.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Nova Família</a>

      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                      <tr>
                          <th>SIAB</th>
                          @if(Auth::user()->eAdmin())
                            <th>Preceptor</th>
                            <th>Aluno</th>
                          @endif
                          <th>Qtd de Pessoas</th>
                          <th>Ações</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>SIAB</th>
                        @if(Auth::user()->eAdmin())
                          <th>Preceptor</th>
                          <th>Aluno</th>
                        @endif
                        <th>Qtd de Pessoas</th>
                        <th>Ações</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($familias as $familia)
                      <tr>
                        <td><a href="{{ route('familias.show', $familia->id) }}">{{ $familia->siab }}</a></td>
                        @if(Auth::user()->eAdmin())
                          <td>{{ $familia->unidade_saude }}</td>
                          <td>{{ $familia->user_id }}</td>
                        @endif
                        <td>{{ $familia->contador }}</td>
                        <td>
                          <form action="{{ route('familias.destroy', $familia->id) }}" method="post">
                            <a title="Editar" class="btn btn-primary waves-effect" href="{{ route('familias.edit', $familia->id) }}">
                              <i class="material-icons">mode_edit</i>
                            </a>
                            <input type="hidden" name="_method" value="DELETE" />
                            @csrf

                            <button type="submit" title="Excluir" class="btn btn-danger waves-effect">
                              <i class="material-icons">delete</i>
                            </button>
                          </form>
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
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
