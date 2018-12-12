<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $usuarios = new User();
        $pacientes = $usuarios->getPacientes(Auth::user()->id);
        $quantidade_pacientes = count($pacientes[0]->pacientes);

        return view('dashboard',compact('quantidade_pacientes'));
    }
}
