<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class CondicaoReferida extends Model
{
    protected $table = 'condicoes_referidas';
    protected $fillable = ['sigla','nome','descricao'];

    public function pacientes()
    {
        return $this->belongsToMany(Paciente::class, 'condicao_referida_paciente');
    }
}
