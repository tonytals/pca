<div class="modal fade" id="adicionarRegistro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="adicionarRegistroLabel">Adicionar Novo Registro</h4>
            </div>
            <form method="POST" action="{{ url('comments') }}">
              <div class="modal-body">

                  @csrf
                  <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
                  <input type="hidden" name="commentable_id" value="{{ $model->id }}" />
                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <div class="form-group">


                              <ckeditor
                                id="message"
                                value="Por favor digite o comentário..."
                                :config="{
                                  toolbar : [
{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
'/',
{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
'/',
{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
{ name: 'about', items: [ 'About' ] }
]
                                          }"
                                name="message">
                              </ckeditor>
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
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
              </div>
            </form>
        </div>
    </div>
</div>
