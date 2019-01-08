@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DASHBOARD</h2>
    </div>

  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.countTo')
@stop

@section('scripts')
$(function () {
    $('.count-to').countTo();
  });
@stop
