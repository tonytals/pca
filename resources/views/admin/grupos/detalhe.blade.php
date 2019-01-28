@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
    </div>

    <painel  titulo='GERENCIAR UNIDADE DE SAUDE: {{ $grupo->name }}'>

      <formulario method="post" action="{{ route('grupos.store') }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
        <div class="rows">
          <div class="col-sm-4">
            Responsável: <a href="{{route('usuarios.show',$grupo->users->first()['id'])}}"><b>{{ $grupo->users->first()['name'] }}</b></a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h5>Adicionar Alunos a Unidade</h5>
            <select name="alunosUnidade[]" id="alunosUnidade" class="ms" multiple="multiple">
              @foreach($usuarios as $aluno)
                {{--  @if(isset($paciente))
                    <option value="{{ $valor->id }}"
                      {{ array_search( $valor->id, array_column($paciente->condicoes_referidas->toArray(), 'id')) !== false ? 'selected' : '' }}
                      >{{$valor->sigla . ' - ' . $valor->nome}}</option>
                  @else --}}
                    <option value="{{$aluno->id}}">{{$aluno->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

      </formulario>
    </painel>

  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.select')
  @include('layouts.includes.multiSelect')
@stop

@section('scripts')
$(function () {
    $('#alunosUnidade').multiSelect({ selectableOptgroup: true });
});
@stop
