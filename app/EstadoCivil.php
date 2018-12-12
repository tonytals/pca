<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estados_civis';
    protected $fillable = ['estado_civil'];
    
}
