@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='FAMÍLIAS CADASTRADAS'>
        <a href="{{ route('familias.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Nova Família</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$familias}}"
        acoes='familias'

      ></tabela-de-listagem>
    </painel>
		</div>
  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
