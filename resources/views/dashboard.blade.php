@extends('layouts.default')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DASHBOARD</h2>
    </div>

      <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-teal hover-expand-effect">
                  <div class="icon">
                      <a href="{{ route('pacientes.index') }}">
                        <i class="material-icons">person</i>
                      </a>

                  </div>
                  <div class="content">
                      <div class="text">PACIENTES</div>
                      <div class="number count-to" data-from="0" data-to="{{$quantidade_pacientes}}" data-speed="1000" data-fresh-interval="20"></div>
                  </div>
              </div>

          </div>
      </div>
  </div>
</section>
@endsection

@section('includeJs')
  @include('layouts.includes.countTo')
@stop

@section('scripts')
$(function () {
    //Widgets count
    $('.count-to').countTo();
  });
@stop
