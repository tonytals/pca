<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use Laravelista\Comments\Commentable;
use Illuminate\Support\Facades\Auth;

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
      'foto',
      'alfabetizado',
      'frequenta_escola',
      'chefe_familia',
      'trabalha',
      'ocupacao',
      'gestante'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function condicoes_referidas()
    {
        return $this->belongsToMany(CondicaoReferida::class, 'condicao_referida_paciente');
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
       return $this->belongsTo(Familia::class, 'id', 'familia_id');
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
        $value = str_replace('/', '-', $value);
        $this->attributes['data_nascimento'] = Date::parse($value)->format('Y-m-d');
    }

    public function getTipoSanguineoIdAttribute($value){
        $tipoSanguineo = TipoSanguineo::find($value);
        return $this->attributes['tipo_sanguineo_id'] = $tipoSanguineo['tipo_sanguineo'];
    }

    public function getFamiliaIdAttribute($value){
        $familia = Familia::find($value);
        $familia = $familia != null ? $familia['familia'] . ' - ' . $familia['sobrenome'] : 'Não Associado';
        return $this->attributes['familia_id'] = $familia;
    }

    public function getFotoAttribute($value){
        if($value == null){
          return $this->attributes['foto'] = '/images/sem-imagem.png';
        }else{
          return $this->attributes['foto'] = '/storage/' . $value;
        }

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

    public function getPacientesPorUsuario($colunas=''){
        return Paciente::whereHas('users', function ($query) {
                    $query->where('user_id', '=', Auth::user()->id);
                })->select($colunas)->get();
    }

    public function getPacientesPorAluno($colunas='',$id){
        return Paciente::whereHas('users', function ($query) use ($id) {
                    $query->where('user_id', '=', $id);
                })->select($colunas)->get();
    }

    public function getAlfabetizadoAttribute($value){
        if($value){
          return 'Alfabetizado ';
        }
    }
    public function getFrequentaEscolaAttribute($value){
        if($value){
          return '- Estudante';
        }
    }
    public function getChefeFamiliaAttribute($value){
        if($value){
          return '- Chefe de Familia';
        }
    }
}
