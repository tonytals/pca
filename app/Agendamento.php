<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['user_id','paciente_id','data_inicio','data_fim'];
}
