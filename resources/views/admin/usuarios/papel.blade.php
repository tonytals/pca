@extends('layouts.app')

@section('content')
	<div class="container">
		<h2 class="center">Lista de Papéis para {{$usuario->name}}</h2>

		<div class="row">
			<form action="{{route('usuarios.papel.store',$usuario->id)}}" method="post">
			{{ csrf_field() }}
			<div class="input-field">
				<select name="papel_id">
					@foreach($papel as $valor)
					<option value="{{$valor->id}}">{{$valor->nome}}</option>
					@endforeach
				</select>
			</div>
				<button class="btn blue">Adicionar</button>
			</form>


		</div>

		<div class="row">
			<table>
				<thead>
					<tr>

						<th>Papel</th>
						<th>Descrição</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>

		</div>

	</div>

@endsection
