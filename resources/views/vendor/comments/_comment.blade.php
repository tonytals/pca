
<ul class="list-unstyled" >
@if(isset($reply) && $reply === true)
  <ul style="list-style: none;margin: -18px 0 0 0;" id="comment-{{ $comment->id }}">
    <div class="header bg-green">
      <h2>
          {{ Date::parse($comment->created_at)->format('j \d\e F\, Y') }} <small>{{ $comment->commenter->name }}</small>
      </h2>
    </div>
@else
  <li id="comment-{{ $comment->id }}">
@endif
    <div class="card">
      @if(!isset($reply))
        <div class="header">
          <h2>
              {{ Date::parse($comment->data_hora_atendimento)->format('j \d\e F\, Y') }} <small>{{ $comment->commenter->name }}</small>
          </h2>
          <ul class="header-dropdown m-r-0">
            <li>
                <i class="material-icons">place</i>{{ $comment->local_atendimento }}
            </li>
            <li>
                <i class="material-icons">watch</i> ------
            </li>
          </ul>
        </div>
      @endif
    <div class="body">
        <h5 >{{ $comment->commenter->name }} <small>- {{ $comment->created_at->diffForHumans() }}</small></h5>

        <p>{!! $comment->comment !!}</p>

        <div style="float:right">
          <modal-link titulo="Responder" css="nenhum" modal="reply-modal-{{ $comment->id }}"></modal-link> |
          <modal-link titulo="Editar" css="nenhum" modal="comment-modal-{{ $comment->id }}"></modal-link> |
          <a href="{{ url('comments/' . $comment->id) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->id }}').submit();" >Deletar</a>
          <form id="comment-delete-form-{{ $comment->id }}" action="{{ url('comments/' . $comment->id) }}" method="POST" style="display: none;">
              @method('DELETE')
              @csrf
          </form>
        </div>

        <modal titulo="Responder Análise" modal="reply-modal-{{ $comment->id }}">
          <form method="POST" action="{{ url('comments/' . $comment->id) }}">
              @csrf
              <div>
                <div class="form-group">
                    <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" name="message" placeholder="Por favor digite o comentário..."></textarea>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                  <button type="submit" class="btn btn-link waves-effect">RESPONDER</button>
              </div>
          </form>
        </modal>

        <modal titulo="Editar Análise" modal="comment-modal-{{ $comment->id }}">
          <form method="POST" action="{{ url('comments/' . $comment->id) }}">
              @method('PUT')
              @csrf
              <div>
                <div class="form-group">
                    <div class="form-line">
                      <label for="message">Atualize sua mensagem:</label>
                        <textarea rows="4" class="form-control no-resize" name="message">{{ $comment->comment }}</textarea>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                  <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
              </div>
          </form>
        </modal>
      </div>
    </div>
        <br />{{-- Margin bottom --}}

        @foreach($comment->children as $child)
            @include('comments::_comment', [
                'comment' => $child,
                'reply' => true
            ])
        @endforeach

@if(isset($reply) && $reply === true)
</ul>
@else
  </li>
@endif
