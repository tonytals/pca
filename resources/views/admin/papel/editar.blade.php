@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">
      <painel titulo='EDITAR PAPEL'>
		<form action="{{ route('papeis.update',$registro->id) }}" method="post">

		{{csrf_field()}}
		{{ method_field('PUT') }}
		@include('admin.papel._form')

		<button class="btn blue">Atualizar</button>


		</form>

  </painel>
  </div>
</div>
</section>


@endsection
