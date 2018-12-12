@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header"></div>

		<div class="row">
      <painel titulo='USUÁRIOS'>
        <a href="{{ route('usuarios.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Usuário</a>

        <tabela-de-listagem
        v-bind:colunas="{{$tituloColunas}}"
        v-bind:registros="{{$usuarios}}"
        acoes='usuarios'

      ></tabela-de-listagem>
    </painel>
		</div>



    <modal titulo="Adicionar" modal="adicionar">
      <formulario method="post" action="{{ route('usuarios.store') }}" token="{{ csrf_token() }}">

        <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="user" placeholder="">
                        <label class="form-label">Usuário</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="">
                        <label class="form-label">Senha</label>
                    </div>
                </div>
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input type="text" class="form-control" name="name">
                          <label class="form-label">Nome Completo</label>
                      </div>
                  </div>
                  <div class="form-group form-float">
                      <div class="form-line">
                          <input type="text" class="form-control" name="email">
                          <label class="form-label">E-mail</label>
                      </div>
                  </div>
              </div>
            </div>

            <div class="align-right">
              <button class="btn btn-link waves-effect">SALVAR</button>
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
            </div>

      </formulario>
    </modal>

  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.datatables')
@stop
