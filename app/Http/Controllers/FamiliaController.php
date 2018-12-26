<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\Familia;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\Paciente;

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
          array('familia' => 'Sobrenome'),
          array('cep' => 'CEP'),
          array('cidade' => 'Cidade'),
          array('contador' => 'Qtd de Pessoas')
        ]);

        $familias = Familia::All();

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
        //
    }

    public function adicionar()
    {
      if(Gate::denies('familias-adicionar')){
        abort(403,"Não autorizado!");
      }

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
        //
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
