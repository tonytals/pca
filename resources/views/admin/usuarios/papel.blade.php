@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
		<div class="block-header"></div>

		<div class="row">
      <painel titulo='Lista de Papéis para {{$usuario->name}}'>
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

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
								<tr>
									<th>Papel</th>
									<th>Descrição</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								@foreach($usuario->papeis as $papel)
									<tr>
										<td>{{ $papel->nome }}</td>
										<td>{{ $papel->descricao }}</td>

										<td>

											<form action="{{route('usuarios.papel.destroy',[$usuario->id,$papel->id])}}" method="post">
													{{ method_field('DELETE') }}
													{{ csrf_field() }}
													<button title="Deletar" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					</div>
			</painel>
		</div>
	</div>

</section>

@endsection
@section('includeJs')
  @include('layouts.includes.datatables')
@stop
