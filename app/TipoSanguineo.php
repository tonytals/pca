<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{
    protected $table = 'tipos_sanguineos';
    protected $fillable = ['tipo_sanguineo'];
}
