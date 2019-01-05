@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2></h2>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <painel titulo='CALENDÁRIO'>
        <div class="row">
            {!! $calendar->calendar() !!}
        </div>
      </painel>
    </div>
  </div>

</section>
@endsection

@section('includeJs')
  @include('layouts.includes.calendar')
@stop

@section('beforeCloseBody')
  {!! $calendar->script() !!}
@stop
