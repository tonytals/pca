@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DASHBOARD</h2>
    </div>

    <div class="row">
      <painel titulo='MEUS ALUNOS'>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Email</th>
                    </tr>
                </tfoot>
                <tbody>
                  @foreach($alunos as $aluno)
                    <tr>
                        <td>{{$aluno->id}}</td>
                        <td><a href="{{route('tutor.showAlunosPreceptores', $aluno->id)}}">{{$aluno->name}}</a></td>
                        <td>{{$aluno->email}}</td>
                    </tr>
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
@stop
