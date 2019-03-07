@auth
    @if($model->comments->count() < 1)
        <div class="card">
          <div class="header">
              <h2>
                  Nenhum atendimento foi feito ainda. <small>Mensagem do sistema</small>
              </h2>
          </div>
        </div>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    @include('comments::_form')
@else
    @if($model->comments->count() < 1)
      <div class="card">
        <div class="header">
            <h2>
                Nenhum atendimento foi feito ainda. <small>Mensagem do sistema</small>
            </h2>
        </div>
      </div>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Authentication required</h5>
            <p class="card-text">You must log in to post a comment.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
        </div>
    </div>
@endauth
