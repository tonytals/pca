<div class="col-sm-4">
	<div class="form-group form-float">
			<div class="form-line">
					<input required type="text" class="form-control validade" name="nome" placeholder="" value="{{ isset($registro->nome) ? $registro->nome : '' }}">
					<label class="form-label">Nome do papel</label>
			</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="form-group form-float">
			<div class="form-line">
					<input required type="text" class="form-control validade" name="descricao" placeholder="" value="{{ isset($registro->descricao) ? $registro->descricao : '' }}">
					<label class="form-label">Descrição</label>
			</div>
	</div>
</div>
