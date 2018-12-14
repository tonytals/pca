<?php

namespace ProntuarioEletronico;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf',
        'rg',
        'user',
        'password',
        'name',
        'email',
        'data_nascimento',
        'sexo',
        'responsavel',
        'matricula',
        'ano',
        'turma',
        'periodo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function eAdmin()
    {
      //return $this->id == 1;
      return $this->existePapel('Admin');
    }

    public function papeis()
    {
        return $this->belongsToMany(Papel::class);
    }

    public function pacientes()
    {
        return $this->belongsToMany(Paciente::class);
    }

    public function adicionaPapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        if($this->existePapel($papel)){
            return;
        }

        return $this->papeis()->attach($papel);

    }
    public function existePapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        return (boolean) $this->papeis()->find($papel->id);

    }
    public function removePapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        return $this->papeis()->detach($papel);
    }

    public function temUmPapelDestes($papeis)
    {
      $userPapeis = $this->papeis;
      return $papeis->intersect($userPapeis)->count();
    }

    public function getPacientes($id)
    {
      return User::with('pacientes')->where('id', $id)->get();
    }

    public function getMinhasPermissoes()
    {
        return $this->papeis()->with('permissoes');
    }
}
