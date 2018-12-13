@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>PRONTUÁRIO</h2>
    </div>


    <div class="row clearfix">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="header">

                  <h2>{{ $paciente->nome_completo }}</h2>

              </div>
                <div class="body">
                  <div class="row clearfix">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <img src="https://cdn2.iconfinder.com/data/icons/lil-faces/226/lil-face-14-512.png" style="max-width:100%" alt="..." class="img-thumbnail">
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <ul class="list-unstyled">
                        <li><b>Data de Nascimento:</b> {{ $paciente->data_nascimento }} </li>
                        <li><b>Tipo Sanguineo:</b> {{ $paciente->tipo_sanguineo['tipo_sanguineo'] }}</li>
                        <li><b>Cidade:</b> São Paulo</li>
                        <li><b>Telefone:</b> 9999.9999</li>
                        <li><b>Sexo:</b> Masculino</li>
                        <li><b>Matrícula:</b> xxxxxxx</li>
                      </ul>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <ul class="list-unstyled">
                        <li>
                          <button type="button" class="btn btn-primary btn-block btn-lg waves-effect">
                              <i class="material-icons">print</i>
                              <span>Imprimir</span>
                          </button>
                        </li>
                        <li>
                          <br />
                          <button type="button" class="btn btn-success btn-block btn-lg waves-effect">
                              <i class="material-icons">file_download</i>
                              <span>Baixar Prontuário</span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                <div class="row clearfix">


                  <ul class="list-unstyled">
                    <li>

                      <div class="card">
                          <div class="header">
                              <h2>
                                  01 de novembro de 2018 <small>Autor: Debora Alavarce</small>
                              </h2>
                              <ul class="header-dropdown m-r-0">
                                  <li>

                                          <i class="material-icons">place</i> Residência do Paciente

                                  </li>
                                  <li>

                                          <i class="material-icons">watch</i> 14h30min

                                  </li>
                              </ul>
                          </div>
                          <div class="body">
                              Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                          </div>
                      </div>

                    </li>
                    <li>

                      <div class="card">
                          <div class="header">
                              <h2>
                                  08 de novembro de 2018 <small>Autor: Debora Alavarce</small>
                              </h2>
                              <ul class="header-dropdown m-r-0">
                                  <li>

                                          <i class="material-icons">place</i> Consultório

                                  </li>
                                  <li>

                                          <i class="material-icons">watch</i> 10h

                                  </li>
                              </ul>
                          </div>
                          <div class="body">
                              Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                          </div>
                      </div>


                      <ul style="list-style: none;margin: -18px 0 0 0;">
                        <li>

                          <div class="card">
                              <div class="header bg-green">
                                  <h2>
                                      08 de novembro de 2018 <small>Autor: Avaliador</small>
                                  </h2>
                                  <ul class="header-dropdown m-r-0">
                                      <li>

                                              <i class="material-icons">place</i> N/A

                                      </li>
                                      <li>

                                              <i class="material-icons">watch</i> 10h

                                      </li>
                                  </ul>
                              </div>
                              <div class="body">
                                  Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                              </div>
                          </div>

                        </li>
                      </ul>
                    </li>
                  </ul>


                </div>
            </div>
        </div>
      </div>
</div>


  </div>
</section>
@endsection
