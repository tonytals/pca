@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='PACIENTES'>
        @can('pacientes-create')
          <a href="{{ route('pacientes.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Paciente</a>
          <a href="{{ route('familias.index') }}" class="btn bg-teal waves-effect">Ver Famílias Cadastradas</a>
        @endcan
        
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
