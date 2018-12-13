<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prontuario extends Model
{
    protected $fillable = [
      'paciente_id',
      'tipo_registro_id',
      'problema_queixa'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function tiposRegistros()
    {
        return $this->belongsTo(TipoRegistro::class, 'tipo_registro_id');
    }

    public function getProntuariosByPaciente($paciente_id)
    {
        return DB::table('prontuarios')
                ->join('tipos_registros', 'tipos_registros.id', '=', 'prontuarios.tipo_registro_id')
                ->join('pacientes', 'pacientes.id', '=', 'prontuarios.paciente_id')
                ->select('prontuarios.id','tipos_registros.tipo_registro','prontuarios.problema_queixa')
                ->where('paciente_id', $paciente_id)
                ->get();
    }

}
