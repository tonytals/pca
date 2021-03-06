@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo="{{ $paciente }}">
        <small slot="small">Prontuários</small>
        <a href="{{ route('pacientes.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Registro</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$prontuarios}}"
        acoes='prontuarios'

      ></tabela-de-listagem>
    </painel>
		</div>
  </div>
</section>

@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
