<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\Familia;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\Paciente;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;
use Groups;

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
          array('siab' => 'SIAB'),
          array('cep' => 'CEP'),
          array('cidade' => 'Cidade'),
          array('contador' => 'Qtd de Pessoas')
        ]);

        if(Auth::user()->eAdmin()){
            $familias = Familia::all();
            $tituloColunas = json_decode($tituloColunas, true);
            array_splice( $tituloColunas, 0, 0, array(array('user_id' => 'Aluno')) );
            $tituloColunas = json_encode($tituloColunas);
        }else{
            $familias = Familia::where('user_id', Auth::user()->id)->get();
        }

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

        $this->validate($request, [
            'siab' => 'unique:familias'
         ],[
            'siab.unique' => 'O número SIAB já existe!'
         ]);

        $data = $request->all();

        if(!isset($data['unidade_saude'])){
            $data['unidade_saude'] = '000000';
        }

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

      $unidadesDeSaude = Groups::getUser(Auth::user()->id)->groups->first();

      /*
      * ENVIAR PARA FORMULARIO PACIENTES NÃO VINCULADOS A FAMILIA
      * !!!!! FAZER !!!!! DO IT !!!!
      */


      return view('familias.form',compact('unidadesDeSaude'));
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
        if(Gate::denies('familias-delete')){
            abort(403,"Não autorizado!");
         }

        Familia::find($id)->delete();
        return back();
    }
}
