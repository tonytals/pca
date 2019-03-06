@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2></h2>
    </div>
    <div class="row">
      <painel titulo='ADICIONAR UNIDADES DE SAÚDE'>
        <form method="POST" action="{{ route('grupos.store') }}">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="name" placeholder="">
                        <label class="form-label">Nome da Unidade</label>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line required">
                    <select class="form-control show-tick" data-live-search="true" name="user_id" required>
                        <option value>-- Responsável Pela Unidade --</option>
                      @foreach($preceptores as $preceptor)
                          @if($preceptor->groups->first()['name'] == null)
                            <option value="{{$preceptor->id}}">{{$preceptor->name}}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" name="description" placeholder="Por favor digite a sua observação..."></textarea>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
            </div>
        </form>
      </painel>
    </div>
  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.select')
@stop
