<?php

namespace ProntuarioEletronico\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProntuarioEletronico\Http\Controllers\Controller;
use ProntuarioEletronico\Paciente;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\Papel;
use ProntuarioEletronico\User;
use Groups;

class TutorController extends Controller
{
  public function aluno_show($id)
  {

    $tituloColunas = json_encode([
      array('id' => '#'),
      array('nome_completo' => 'Nome'),
      array('email' => 'E-mail'),
      array('sexo' => 'Sexo'),
      array('familia_id' => 'Familia')
    ]);

    $pacientes = new Paciente();
    $pacientes = $pacientes->getPacientesPorAluno(['id','nome_completo','email','sexo','familia_id'],$id);

    return view('pacientes.index', compact('pacientes', 'tituloColunas'));
  }

  public function index()
  {

    if(Gate::denies('tutores-index')){
        abort(403,"Não autorizado!");
    }


    $papelTutor = Papel::where('nome','Tutor')->first();

    $usuarios = User::whereHas('papeis', function ($query) use ($papelTutor) {
            $query->where("papel_user.papel_id", "=", $papelTutor->id);
    })->with('papeis')->get();

    foreach ($usuarios as $tutor) {
      $tutores[] = Groups::getUser($tutor->id);
    }

    return view('admin.tutores.index', compact('tutores'));
  }

}
