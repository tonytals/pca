@extends('layouts.default')

@section('content')

<section class="content">
	<div class="container-fluid">
		<div class="block-header"></div>

		<div class="row">
			<painel titulo='ADICIONAR PAPEL'>


				<div class="row">
					<form action="{{ route('papeis.store') }}" method="post">

						{{csrf_field()}}
						@include('admin.papel._form')

						<button class="btn btn-primary waves-effect">Adicionar</button>


					</form>
				</painel>
			</div>

		</div>
	</div>
</section>

@endsection
