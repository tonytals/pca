@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DASHBOARD</h2>
    </div>

    <div class="row">
      <painel titulo='PRECEPTORES'>
        <button id="btn" class="btn bg-blue waves-effect">Enviar E-mail a Todos os Preceptores</button>
        <div class="table-responsive">
            <table id="tabelaPreceptores" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                  @foreach($preceptores as $preceptor)
                    @if($preceptor->id != Auth::user()->id)
                        <tr>
                            <td>{{$preceptor->id}}</td>
                            <td><a href="{{route('tutor.showAlunosPreceptores', $preceptor->id)}}">{{$preceptor->name}}</a></td>
                            <td class="email">{{$preceptor->email}}</td>
                            <td>
                              <a type="button" href="mailto:{{$preceptor->email}}?Subject=Contato%20Prontuario%20Academico" class="btn bg-green waves-effect">
                                    <i class="material-icons">email</i>
                                </a>
                            </td>
                        </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>

      </painel>
		</div>

  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.countTo')
  @include('layouts.includes.datatables')
@stop

@section('scripts')
$(function () {
    $('.count-to').countTo();
  });
  $('#btn').click( function( ) {
    var emails = '';
        $('#tabelaPreceptores td.email').each( function( ) {
            emails += $(this).html() + ';';
        } );
        window.location = 'mailto:' + $.trim(emails) + '?subject=Contato%20Prontuario%20Academico';
    } );
@stop
