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
        'siab',
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
        'sobrenome',
        'unidade_saude'
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

    public function setCadUnicoAttribute($value)
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
      if($value != ''){

        $this->attributes['renda_familiar'] = str_replace('R$ ', '', $value);
        $this->attributes['renda_familiar'] = str_replace(',', '', $this->attributes['renda_familiar']);

      }else{
        $this->attributes['renda_familiar'] = 0;
      }

    }

    public function getEnergiaEletricaAttribute($value)
    {
       if($value){
         return 'Sim';
       }else{
         return 'Não';
       }
    }

    public function getUserIdAttribute($value)
    {

        $user = User::find($value);

        try {
          return $this->attributes['user_id'] = $user->name;
        } catch (\Exception $e) {
          return $this->attributes['user_id'] = $value;
        }

    }

}
