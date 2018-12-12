@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='PACIENTES'>
        <a href="{{ route('pacientes.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Paciente</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$pacientes}}"
        acoes='pacientes'

      ></tabela-de-listagem>
    </painel>
		</div>
  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
