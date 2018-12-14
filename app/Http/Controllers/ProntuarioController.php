<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\Prontuario;
use ProntuarioEletronico\Paciente;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;

class ProntuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $prontuarios = Prontuario::with(['paciente.users'])
                                  ->where('id', $id)
                                  ->get();

       if(!collect($prontuarios[0]->paciente->users)
                  ->contains('id', Auth::user()->id)){
          return redirect()->action('PacienteController@index')
                          ->with('info', 'Sem permissão para acessar esse paciente');
       }

       $paciente = $prontuarios[0]->paciente;
       $prontuarios = $prontuarios[0];

        return view('prontuarios.index',compact('prontuarios','paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
