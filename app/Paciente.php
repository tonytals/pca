<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
      'familia_id',
      'cpf',
      'rg',
      'nome_completo',
      'estado_civil_id',
      'data_nascimento',
      'email',
      'sexo',
      'religiao',
      'nome_pai',
      'nome_mae',
      'tipo_sanguineo_id',
      'alfabetizado',
      'frequenta_escola',
      'chefe_familia',
      'trabalha',
      'profissao',
      'gestante'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function estado_civil()
    {
        return $this->hasOne(EstadoCivil::class);
    }

    public function tipo_sanguineo()
    {
        return $this->hasOne(TipoSanguineo::class);
    }

    public function familia()
    {
       return $this->hasOne(Familia::class);
    }

    public function prontuarios()
    {
        return $this->hasMany(Prontuario::class);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }

    public function setDataNascimentoAttribute($value){
        $originalDate = $value;
        $this->attributes['data_nascimento'] =  date("Y-m-d", strtotime($originalDate));
    }
}
