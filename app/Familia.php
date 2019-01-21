<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Familia extends Model
{
    use Commentable;

    protected $fillable = [
        'user_id',
        'segmento',
        'area',
        'micro_area',
        'familia',
        'observacoes',
        'renda_familiar',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'numero',
        'complemento',
        'telefone',
        'celular',
        'tipo_casa',
        'energia_eletrica',
        'numero_comodos',
        'tratamento_agua',
        'abastecimento_agua',
        'destino_lixo',
        'destino_fezes_urina',
        'nis_responsavel',
        'cad_unico',
        'sobrenome'
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

    public function setEnergiaEletricaAttribute($value)
    {
        if($value == 'on'){
          $this->attributes['energia_eletrica'] = 1;
        }else{
          $this->attributes['energia_eletrica'] = 0;
        }
    }

    public function setBolsaFamiliaAttribute($value)
    {
        if($value == 'on'){
          $this->attributes['energia_eletrica'] = 1;
        }else{
          $this->attributes['energia_eletrica'] = 0;
        }
    }

    public function setCepAttribute($value)
    {
        $this->attributes['cep'] = preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }

    public function setCelularAttribute($value)
    {
        $this->attributes['celular'] = preg_replace('/[^a-zA-Z0-9]/', '', $value);
    }

    public function setRendaFamiliarAttribute($value)
    {
        $this->attributes['renda_familiar'] = str_replace('R$ ', '', $value);
        $this->attributes['renda_familiar'] = str_replace(',', '', $this->attributes['renda_familiar']);
    }

    public function getEnergiaEletricaAttribute($value)
    {
       if($value){
         return 'Sim';
       }else{
         return 'Não';
       }
    }

}
