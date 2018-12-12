<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class TipoRegistro extends Model
{
    protected $table = 'tipos_registros';
    protected $fillable = ['tipo_registro'];

    public function prontuarios()
    {
        return $this->hasMany(Prontuario::class);
    }

}
