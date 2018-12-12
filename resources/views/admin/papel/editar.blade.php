@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
	<h2 class="center">Editar Papel</h2>

	<div class="row">
		<form action="{{ route('papeis.update',$registro->id) }}" method="post">

		{{csrf_field()}}
		{{ method_field('PUT') }}
		@include('admin.papel._form')

		<button class="btn blue">Atualizar</button>


		</form>

	</div>

</div>
</div>
</section>


@endsection
