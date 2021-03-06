@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">
      <painel titulo='USUÁRIOS'>
        <a href="{{ route('usuarios.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Usuário</a>
        <a href="{{ route('usuarios.importar') }}" class="btn bg-teal waves-effect">Importar Usuários (CSV)</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$usuarios}}"
        acoes='usuarios'
        acoesextras='{{$extras}}'
      ></tabela-de-listagem>

      </painel>
		</div>
  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
