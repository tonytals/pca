@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
    </div>

    <painel  titulo='GERENCIAR GRUPO: {{ $grupo->name }}'>

      <formulario method="post" action="{{ route('grupos.addAluno') }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-4">
            <input type="hidden" name="idResponsavel" value="{{ $grupo->users->first()['id'] }}">
            Responsável: <a href="{{route('usuarios.show',$grupo->users->first()['id'])}}"><b>{{ $grupo->users->first()['name'] }}</b></a>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-12">
            <h5>Adicionar Alunos a Unidade</h5>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-sm-6">
            <select name="alunosUnidade" id="alunosUnidade" class="form-control show-tick" data-live-search="true">
              @foreach($usuarios as $aluno)

                    <option value="{{$aluno->id}}">{{$aluno->name}}</option>

              @endforeach
            </select>
          </div>

          <div class="col-sm-4">
            <button type="submit" class="btn bg-teal waves-effect">
                <i class="material-icons">add</i>
                <span>Adicionar</span>
            </button>
          </div>
        </div>
      </formulario>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable tabelaPreceptores">
                  <thead>
                      <tr>
                          <th>Nome</th>
                          <th>Ações</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @if($grupo->users->count() > 1)
                      @foreach($grupo->users as $aluno)
                        @if($aluno->id != $grupo->users->first()['id'])
                          <tr>
                            <td><a href="{{route('tutor.showAlunosPreceptores', $aluno->id)}}">{{ $aluno->name }}</a></td>
                            <td>
                              <a class="btn btn-danger waves-effect" href="{{route('grupos.removeAluno', [$grupo->users->first()['id'], $aluno->id])}}">
                                  <i class="material-icons">delete</i>
                                  <span>Remover do Grupo</span>
                              </a>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    @else
                      <tr>
                        <td colspan="2">
                          Sem Registros
                        </td>
                      </tr>
                    @endif
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
  @include('layouts.includes.select')
@stop

@section('scripts')
$(function () {
    $('#alunosUnidade').multiSelect({ selectableOptgroup: true });
});
@stop
