@extends('layouts.default')

@section('content')

<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">
      <painel titulo='PERMISSÕES PARA O PAPEL: {{$papel->nome}}'>

				<div class="row">
					<form action="{{route('papeis.permissao.store',$papel->id)}}" method="post">
						{{ csrf_field() }}
						<div class="col-sm-4">
							<div class="input-field">
								<select name="permissao_id" class="form-control show-tick" data-live-search="true">
									@foreach($permissao as $valor)
									<option value="{{$valor->id}}">{{$valor->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<button class="btn btn-primary waves-effect">Adicionar</button>
						</div>
					</form>


				</div>

				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
							<tr>
								<th>Permissão</th>
								<th>Descrição</th>
								<th>Ação</th>
							</tr>
						</thead>
						<tbody>
						@foreach($papel->permissoes as $permissao)
							<tr>
								<td>{{ $permissao->nome }}</td>
								<td>{{ $permissao->descricao }}</td>
								<td>
									<form action="{{route('papeis.permissao.destroy',[$papel->id,$permissao->id])}}" method="post">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
											<button title="Deletar" class="btn bg-red"><i class="material-icons">delete</i></button>
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
	@include('layouts.includes.select')
  @include('layouts.includes.datatables')
@stop
