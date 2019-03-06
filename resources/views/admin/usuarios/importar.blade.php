@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
    </div>

    <div class="row">
      <painel titulo='IMPORTAR USUÁRIOS (CSV)'>
        <div class="alert alert-warning">
            <strong>Atenção!</strong> Para que a importação funcione corretamente verifique se existe no CSV os campos obrigatórios.
            <ul>
              <li>O <b>CSV</b> deve estar separado por virgulas</li>
              <li>Nome</li>
              <li>E-mail</li>
              <li>Senha</li>
              <li>Papel (Aluno / Preceptor / Tutor)</li>
            </ul>
        </div>
        <formulario id="importarCsv" method="post" action="{{ route('usuarios.importarCsv') }}" token="{{ csrf_token() }}" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <a href="/download/csv_modelo_import_users.csv">
                <button type="button" class="btn bg-indigo waves-effect">
                    <i class="material-icons">save</i>
                    <span>Download CSV Modelo</span>
                </button>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-5">
              <div class="form-group form-float">
                <div class="form-line">
                  <label for="foto">Arquivo (.csv)</label>
                  <input type="file" id="arquivo" name="arquivo">
                </div>
              </div>
            </div>
          </div>
          <div class="align-right">
              <button class="btn btn-link waves-effect">SALVAR</button>
          </div>
        </formulario>
      </painel>
		</div>

  </div>
</section>
@endsection
