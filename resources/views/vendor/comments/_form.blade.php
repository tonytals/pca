<div class="card">
    <div class="header">
        <h2>
            Adicionar nova análise.
        </h2>
    </div>
    <div class="body">
        <form method="POST" action="{{ url('comments') }}">
            @csrf
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->id }}" />
            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group">
                    <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" name="message" placeholder="Por favor digite o comentário..."></textarea>
                    </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-6">
                  <b>Data e Hora do Atendimento</b>
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">date_range</i>
                      </span>
                      <div class="form-line">
                          <input type="text" name="data_hora_atendimento" class="form-control datetime" placeholder="Ex: 30/07/2016 13:45">
                      </div>
                  </div>

              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                      <div class="form-line">
                        <b>Local do Atendimento</b>
                        <select name="local_atendimento" class="form-control">
                            <option value="Residencial">Atendimento Residencial</option>
                            <option value="Hospital">Atendimento no Hospital</option>
                            <option value="UBS">Atendimento Posto de Saúde</option>
                        </select>
                      </div>
                  </div>
              </div>
            </div>
            <button  type="submit" class="btn btn-link waves-effect">SALVAR</button>
        </form>
    </div>
</div>
<br />
