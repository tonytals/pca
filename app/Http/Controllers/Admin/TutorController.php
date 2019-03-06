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
    $pacientes = $pacientes->getPacientesPorAluno(['id','nome_completo','email','sexo','familia_id'], $id);

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

    $tutores = [];

    foreach ($usuarios as $tutor) {
      $tutores[] = Groups::getUser($tutor->id);
    }

    return view('admin.tutores.index', compact('tutores'));
  }

  public function showAlunosPreceptores($id)
  {

    $user = Groups::getUser($id);
    $listaAlunos = $user->groups->first()->users;

    $alunos = [];

    foreach ($listaAlunos as $key => $aluno) {
      if(User::find($aluno->id)->papeis->first()->nome == 'Aluno'){
        $alunos[] = $aluno;
      };
    }
    
    return view('admin.tutores.listaAlunos', compact('alunos'));

  }

}
