@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">

    </div>
    <div class="row">
      <painel titulo='PACIENTES'>
        @can('pacientes-create')
          <a href="{{ route('pacientes.adicionar') }}" class="btn btn-primary waves-effect">Adicionar Paciente</a>
        <!--  <a href="{{ route('familias.index') }}" class="btn bg-teal waves-effect">Ver Famílias Cadastradas</a> -->
        @endcan

        <div class="row clearfix">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Familia - SIAB</th>
                            <th>Idade</th>
                            <th>Último Atendimento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Familia - SIAB</th>
                          <th>Idade</th>
                          <th>Último Atendimento</th>
                          <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      @foreach($pacientes as $paciente)
                        <tr>
                          <td>{{ $paciente->id }}</td>
                          <td><a href="{{ route('pacientes.show', $paciente->id) }}">{{ $paciente->nome_completo }}</a></td>
                          <td>
                            @if($paciente->getOriginal('familia_id') != null)
                              <a href="{{ route('familias.show', $paciente->getOriginal('familia_id')) }}">{{ $paciente->familia_id }}</a>
                            @else
                              {{ $paciente->familia_id }}
                            @endif
                          </td>
                          <td>{{ Date::parse($paciente->data_nascimento)->age .' anos' }}</td>
                          <td>
                            @if($paciente->ultimo_atendimento != null)
                              {{ Date::parse($paciente->ultimo_atendimento)->format('j \d\e F\, Y') }}<br />
                              <small><timeago datetime="{{ $paciente->ultimo_atendimento }}" locale="pt-BR"></timeago></small>
                            @endif
                          </td>
                          <td>
                            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="post">
                              <a title="Editar" class="btn btn-primary waves-effect" href="{{ route('pacientes.edit', $paciente->id) }}">
                                <i class="material-icons">mode_edit</i>
                              </a>
                              <input type="hidden" name="_method" value="DELETE" />
                              @csrf

                              <button type="submit" title="Excluir" class="btn btn-danger waves-effect">
                                <i class="material-icons">delete</i>
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
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
