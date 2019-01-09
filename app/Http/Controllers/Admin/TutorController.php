<?php

namespace ProntuarioEletronico\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProntuarioEletronico\Http\Controllers\Controller;
use ProntuarioEletronico\Paciente;

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

}
