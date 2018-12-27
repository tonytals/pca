<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;
use Laravelista\Comments\Comment;

class DashboardController extends Controller
{
    public function index()
    {

        $usuarios = new User();
        $pacientes = $usuarios->getPacientes(Auth::user()->id);
        $quantidade_pacientes = count($pacientes[0]->pacientes);

        $comentarios = new Comment();
        $quantidade_comentarios = $comentarios::all()->where('commenter_id', Auth::user()->id)->count();

        $locais_atendimento = $comentarios::all()->where('commenter_id', Auth::user()->id)->groupBy('local_atendimento');

        return view('dashboard',compact('quantidade_pacientes','quantidade_comentarios','locais_atendimento'));
    }
}
