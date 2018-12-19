@extends('layouts.default')

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">
      <painel titulo='PAPÉIS DE SISTEMA'>
        <a href="{{route('papeis.create')}}" class="btn btn-primary waves-effect">Adicionar Novo Papel</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$registros}}"
        acoes='papeis'

      ></tabela-de-listagem>
    </painel>
		</div>


  </div>
</section>
	<!--<div class="container">
		<h2 class="center">Lista de Papéis</h2>

		<div class="row">
			<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
				@foreach($registros as $registro)
					<tr>
						<td>{{ $registro->id }}</td>
						<td>{{ $registro->nome }}</td>
						<td>{{ $registro->descricao }}</td>

						<td>


							<form action="{{route('papeis.destroy',$registro->id)}}" method="post">
								<a title="Editar" class="btn orange" href="{{ route('papeis.edit',$registro->id) }}"><i class="material-icons">mode_edit</i></a>
								<a title="Permissões" class="btn blue" href="{{route('papeis.permissao',$registro->id)}}"><i class="material-icons">lock_outline</i></a>


									{{ method_field('DELETE') }}
									{{ csrf_field() }}
									<button title="Deletar" class="btn red"><i class="material-icons">delete</i></button>
							</form>








						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

		</div>
		<div class="row">
			<a class="btn blue" href="{{route('papeis.create')}}">Adicionar</a>
		</div>
	</div>-->

@endsection
