@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
    </div>

    <painel  titulo='GERENCIAR UNIDADE DE SAUDE: {{ $grupo->name }}'>

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
                  @if(count($aluno->grupos) == 0)
                    <option value="{{$aluno->id}}">{{$aluno->name}}</option>
                  @endif
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
                    @foreach($grupo->users as $aluno)
                      @if($aluno->id != $grupo->users->first()['id'])
                        <tr>
                          <td><a href="{{route('tutor.aluno', $aluno->id)}}">{{ $aluno->name }}</a></td>
                          <td>
                            <a class="btn btn-danger waves-effect" href="">
                                <i class="material-icons">delete</i>
                                <span>Remover da Unidade</span>
                            </a>
                          </td>
                        </tr>
                      @endif
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
  @include('layouts.includes.select')
@stop

@section('scripts')
$(function () {
    $('#alunosUnidade').multiSelect({ selectableOptgroup: true });
});
@stop
