<?php

namespace ProntuarioEletronico;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Familia extends Model
{
    use Commentable;

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

}
