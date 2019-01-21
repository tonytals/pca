<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\Familia;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\Paciente;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::denies('familias-view')){
          abort(403,"Não autorizado!");
        }

        $tituloColunas = json_encode([
          array('familia' => '#'),
          array('cep' => 'CEP'),
          array('cidade' => 'Cidade'),
          array('contador' => 'Qtd de Pessoas')
        ]);

        $familias = Familia::All()->where('user_id', Auth::user()->id);

        foreach ($familias as $familia) {
          $familia->contador = Paciente::where('familia_id', $familia->id)->count();
        }

        return view('familias.index', compact('tituloColunas','familias'));
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
        $data = $request->all();

        $familia = new Familia();
        $familia = Familia::create($data);

        return redirect()->action('FamiliaController@index');
    }

    public function adicionar()
    {
      if(Gate::denies('familias-adicionar')){
        abort(403,"Não autorizado!");
      }

      /*
      * ENVIAR PARA FORMULARIO PACIENTES NÃO VINCULADOS A FAMILIA
      * !!!!! FAZER !!!!! DO IT !!!!
      */

      $pacientes = new Paciente();
      $pacientes = $pacientes->whereHas('users', function ($query) {
                  $query->where('user_id', '=', Auth::user()->id);
              })->where('familia_id', null)->get();

      /*
      * ENVIAR PARA FORMULARIO PACIENTES NÃO VINCULADOS A FAMILIA
      * !!!!! FAZER !!!!! DO IT !!!!
      */


      return view('familias.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Familia::with('Pacientes')->where('id', $id)->get();
        $familia = $data[0];

        foreach ($data as $membro) {
            $familia['membros'] = $membro->pacientes;
        }

        return view('familias.prontuario',compact('familia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('familia-edit')){
          abort(403,"Não autorizado!");
        }

        $familia = Familia::find($id);

        return view('familias.form',compact('familia'));
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
        $data = $request->all();

        $familia = new Familia();
        $familia->find($id)->update($data);

        return redirect()->action('FamiliaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $familia = new Familia();
      $familia->find($id)->detele();

      return redirect()->back();
    }
}
