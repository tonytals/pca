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
      ]);

      $usuarios = new User();
      $pacientes = $usuarios->getPacientes(Auth::user()->id);
      $pacientes = $pacientes[0]->pacientes;

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

      $paciente = new Paciente();
      $paciente = Paciente::create($data);

      $paciente->users()->attach($data['user_id']);

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

      if(empty(Paciente::find($id)
                        ->users()
                        ->where('user_id', Auth::user()->id)
                        ->get()->count()
                      ))
      {
        return redirect()->back()->with('info', 'Sem permissão para acessar esse paciente');
      };

      $prontuarios = new Prontuario();
      $prontuarios = $prontuarios->getProntuariosByPaciente($id);

      $paciente = Paciente::find($id)->nome_completo;

      $tituloColunas = json_encode([
        array('id' => '#'),
        array('tipo_registro' => 'Tipo de Registro'),
        array('problema_queixa' => 'Problema / Queixa')
      ]);

      return view('pacientes.listprontuarios',
        compact(
          'paciente',
          'prontuarios',
          'tituloColunas'
        ));
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

      return view('pacientes.form',
        compact(
          'paciente',
          'estadoCivil',
          'tipoSanguineo',
          'familia'
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
      if(Gate::denies('pacientes-destroy')){
          abort(403,"Não autorizado!");
      }
    }

    public function adicionar()
    {
      if(Gate::denies('pacientes-create')){
          abort(403,"Não autorizado!");
      }

      $estadoCivil = EstadoCivil::all();
      $tipoSanguineo = TipoSanguineo::all();
      $familia = Familia::all();

      return view('pacientes.form',
        compact(
          'estadoCivil',
          'tipoSanguineo',
          'familia'
        ));
    }
}
