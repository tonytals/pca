<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\Paciente;
use ProntuarioEletronico\User;
use Illuminate\Support\Facades\Auth;
use ProntuarioEletronico\EstadoCivil;
use ProntuarioEletronico\TipoSanguineo;
use ProntuarioEletronico\Familia;
use ProntuarioEletronico\Prontuario;
use ProntuarioEletronico\TipoRegistro;
use ProntuarioEletronico\CondicaoReferida;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Gate::denies('pacientes-view')){
        abort(403,"Não autorizado!");
      }

      $tituloColunas = json_encode([
        array('id' => '#'),
        array('nome_completo' => 'Nome'),
        array('email' => 'E-mail'),
        array('sexo' => 'Sexo'),
        array('familia_id' => 'Familia')
      ]);

      $pacientes = new Paciente();
      $pacientes = $pacientes->getPacientesPorUsuario(['id','nome_completo','email','sexo','familia_id']);

      return view('pacientes.index', compact('pacientes', 'tituloColunas'));

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
      if(Gate::denies('pacientes-create')){
          abort(403,"Não autorizado!");
      }

      $data = $request->all();
      //$data['doencasCondicoes'] = json_encode($data['doencasCondicoes']);

      if($request->file('foto') != null){
        $arquivo = $request->file('foto')->store('pacientes','public');
        $data['foto'] = $arquivo;
      }

      $paciente = new Paciente();
      $paciente = Paciente::create($data);

      $paciente->users()->attach($data['user_id']);
      $paciente->condicoes_referidas()->attach($data['doencasCondicoes']);

      return redirect()->action('PacienteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(Gate::denies('pacientes-show')){
          abort(403,"Não autorizado!");
      }

      if(Auth::user()->papeis[0]->id != 5 && Auth::user()->papeis[0]->id != 4)
      {
        $canAccess = Paciente::findOrFail($id)
                          ->users()
                          ->where('user_id', Auth::user()->id)
                          ->get()->count();

        if(empty($canAccess) || $canAccess == 0)
        {
          return redirect()->action('PacienteController@index')
                            ->with('info', 'Sem permissão para acessar esse paciente');
        };
      }

      $paciente = Paciente::find($id);

      return view('pacientes.prontuario',compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $paciente = Paciente::where('id', $id)->get();
      $paciente = $paciente[0];

      $estadoCivil = EstadoCivil::all();
      $tipoSanguineo = TipoSanguineo::all();
      $familia = Familia::all();
      $condicoesReferidas = CondicaoReferida::all();

      return view('pacientes.form',
        compact(
          'paciente',
          'estadoCivil',
          'tipoSanguineo',
          'familia',
          'condicoesReferidas'
        ));
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

        if($request->file('foto') != null){
          $arquivo = $request->file('foto')->store('pacientes','public');
          $data['foto'] = $arquivo;
        }

        $paciente = new Paciente();
        $paciente = Paciente::find($id)->update($data);

        $paciente = Paciente::find($id);
        $paciente->condicoes_referidas()->sync($data['doencasCondicoes']);

        return redirect()->action('PacienteController@show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Gate::denies('pacientes-destroy')){
          abort(403,"Não autorizado!");
      }

      Paciente::find($id)->delete();
      return redirect()->back();

    }

    public function adicionar()
    {
      if(Gate::denies('pacientes-create')){
          abort(403,"Não autorizado!");
      }

      $estadoCivil = EstadoCivil::all();
      $condicoesReferidas = CondicaoReferida::all();
      $tipoSanguineo = TipoSanguineo::all();
      $familia = Familia::all()->where('user_id', Auth::user()->id);

      return view('pacientes.form',
        compact(
          'estadoCivil',
          'tipoSanguineo',
          'familia',
          'condicoesReferidas'
        ));
    }
}
