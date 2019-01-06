<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['user_id','paciente_id','data_inicio','data_fim','observacao'];

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id', 'paciente_id');
    }

    public function getPacienteIdAttribute($value){
        $paciente = Paciente::find($value);
        return $this->attributes['paciente_id'] = $paciente['nome_completo'];
    }

}
