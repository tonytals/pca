
<ul class="list-unstyled">
@if(isset($reply) && $reply === true)
  <div id="comment-{{ $comment->id }}" >
@else
  <li id="comment-{{ $comment->id }}" >
@endif
    <div class="card">
        <div class="header">
          <img src="" alt="{{ $comment->commenter->name }} Avatar">
        </div>
    <div class="body">
        <h5 >{{ $comment->commenter->name }} <small>- {{ $comment->created_at->diffForHumans() }}</small></h5>

        <p>
          {{--   @can('reply-to-comment', $comment) --}}
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->id }}" >Responder</button>
            {{--@endcan--}}

            {{--   @can('edit-comment', $comment) --}}
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->id }}" >Editar</button>
            {{--   @endcan

            {{--   @can('delete-comment', $comment) --}}
                <a href="{{ url('comments/' . $comment->id) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->id }}').submit();" >Deletar</a>
                <form id="comment-delete-form-{{ $comment->id }}" action="{{ url('comments/' . $comment->id) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            {{--   @endcan --}}
        </p>

        {{--   @can('edit-comment', $comment) --}}
            <div  id="comment-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
                <div >
                    <div >
                        <form method="POST" action="{{ url('comments/' . $comment->id) }}">
                            @method('PUT')
                            @csrf
                            <div>
                                <h5>Edita Análise</h5>
                                <button type="button">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="message">Atualize sua mensagem:</label>
                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button">Cancelar</button>
                                <button type="submit">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {{--   @endcan --}}

      {{--     @can('reply-to-comment', $comment) --}}
            <div id="reply-modal-{{ $comment->id }}" tabindex="-1" role="dialog">
                <div >
                    <div >
                        <form method="POST" action="{{ url('comments/' . $comment->id) }}">
                            @csrf
                            <div >
                                <h5>Responder Análise</h5>
                                <button type="button" class="close">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="message">Digite sua resposta</label>
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" >Cancelar</button>
                                <button type="submit">Responder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {{--   @endcan --}}

        <br />{{-- Margin bottom --}}

        @foreach($comment->children as $child)
            @include('comments::_comment', [
                'comment' => $child,
                'reply' => true
            ])
        @endforeach
    </div>
  </div>
@if(isset($reply) && $reply === true)
  </div>
@else
  </li>
@endif
