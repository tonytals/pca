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
                  @if(isset($alunos) && $alunos->count() > 1)
                    @foreach($alunos as $aluno)
                      <tr>
                        @if($aluno->id != Auth::user()->id)
                          <td>{{$aluno->id}}</td>
                          <td><a href="{{route('tutor.aluno', $aluno->id)}}">{{$aluno->name}}</a></td>
                          <td>{{$aluno->email}}</td>
                        @endif
                      </tr>
                    @endforeach
                  @else
                    <tr>
                        <td colspan="3">Não há alunos registrados</td>
                    </tr>
                  @endif

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
