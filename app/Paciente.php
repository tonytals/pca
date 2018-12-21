<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use Laravelista\Comments\Commentable;

class Paciente extends Model
{

    use Commentable;

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
        return $this->hasOne(EstadoCivil::class, 'id', 'estado_civil_id');
    }

    public function tipo_sanguineo()
    {
        return $this->hasOne(TipoSanguineo::class, 'id', 'tipo_sanguineo_id')->select('tipo_sanguineo');
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

    public function getDataNascimentoAttribute($value){
        return $this->attributes['data_nascimento'] = Date::parse($value)->format('j \d\e F\, Y') . ' ('. Date::parse($value)->age .' anos)';
    }

    public function getSexoAttribute($value){
        if($value == 'M'){
            return 'Masculino';
        }elseif($value == 'F'){
            return 'Feminino';
        }else{
            return 'Não Informado';
        }
    }
}
