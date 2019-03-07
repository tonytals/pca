<?php

namespace ProntuarioEletronico\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProntuarioEletronico\Http\Controllers\Controller;
use ProntuarioEletronico\User;
use ProntuarioEletronico\Papel;
use ProntuarioEletronico\Paciente;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::denies('usuario-view')){
          abort(403,"Não autorizado!");
        }

        $tituloColunas = json_encode([
          array('id' => '#'),
          array('name' => 'Nome'),
          array('cpf' => 'CPF'),
          array('email' => 'E-mail'),
          array('papeis' => 'Papeis')
        ]);

        $extras = json_encode([
          array("rota"  => "usuarios.papel",
                "icone" => "assignment_ind",
                "titulo" => "Papéis do Usuário",
                "class"    => "btn bg-teal waves-effect"),
        ]);

        $usuarios = User::select('id','name','cpf','email')->with('papeis:nome')->get();

        return view('admin.usuarios.index',compact('usuarios','tituloColunas','extras'));
    }

    public function papel($id)
    {
      if(Gate::denies('usuario-edit')){
        abort(403,"Não autorizado!");
      }

      $tituloColunas = json_encode([
        array('nome' => 'Nome'),
        array('descricao' => 'Descrição')
      ]);


      $usuario = User::find($id);
      $papel = Papel::all();

      return view('admin.usuarios.papel',compact('usuario','papel','tituloColunas'));
    }

    public function papelStore(Request $request,$id)
    {
        if(Gate::denies('usuario-edit')){
          abort(403,"Não autorizado!");
        }
        $usuario = User::find($id);
        $dados = $request->all();
        $papel = Papel::find($dados['papel_id']);
        $usuario->adicionaPapel($papel);
        return redirect()->back();
    }

    public function papelDestroy($id,$papel_id)
    {
      if(Gate::denies('usuario-edit')){
        abort(403,"Não autorizado!");
      }
      $usuario = User::find($id);
      $papel = Papel::find($papel_id);
      $usuario->removePapel($papel);
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(Gate::denies('usuario-create')){
          abort(403,"Não autorizado!");
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if(Gate::denies('usuario-create')){
        abort(403,"Não autorizado!");
      }

      $data = $request->all();

      if($request->file('foto') != null){
        $arquivo = $request->file('foto')->store('usuarios','public');
        $data['foto'] = $arquivo;
      }

      $validator = \Validator::make($data, [
          'email' => 'required'
      ]);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $data['password'] = Hash::make($data['password']);

      $user = new User();
      $user = User::create($data);

      $user->papeis()->attach($data['papel_id']);

      return redirect()->action('Admin\UsuarioController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Gate::denies('usuario-edit')){
        abort(403,"Não autorizado!");
      }

      $usuario = User::with('papeis:nome,papel_id')->where('id', $id)->get();
      $papel = Papel::all();
      $usuario = $usuario[0];

      return view('admin.usuarios.form',compact('usuario','papel'));
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
        if(Gate::denies('usuario-edit')){
          abort(403,"Não autorizado!");
        }

        $data = $request->all();

        if($request->file('foto') != null){
          $arquivo = $request->file('foto')->store('usuarios','public');
          $data['foto'] = $arquivo;
        }

        $user = new User();
        $newPassword = $request->get('password');

        if(empty($newPassword)){
          unset($data['password']);
        }else{
          $data['password'] = Hash::make($data['password']);
        }

        $user->find($id)->update($data);
        return redirect()->back();
    }

    public function perfil($id)
    {

      $usuario = User::find($id);

      return view('admin.usuarios.perfil',compact('usuario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('usuario-delete')){
          abort(403,"Não autorizado!");
        }

        User::find($id)->delete();
        return redirect()->back();
    }

    public function adicionar()
    {
      if(Gate::denies('usuario-create')){
          abort(403,"Não autorizado!");
      }

      $papel = Papel::all();

      return view('admin.usuarios.form',compact('papel'));
    }

    public function importar()
    {
      return view('admin.usuarios.importar');
    }

    public function importarCsv(Request $request)
    {

      $data = $request->all();

      if($request->file('arquivo') != null){

        $extension = $request->file('arquivo')->getClientOriginalExtension();
        $valid_extension = array("csv");

        if(in_array(strtolower($extension),$valid_extension)){

          $arquivo = $request->file('arquivo')->store('importarcsv','public');

          $data = array_map('str_getcsv', file('storage/' . $arquivo, FILE_IGNORE_NEW_LINES));
          array_walk($data, function(&$a) use ($data) {
            $a = array_combine($data[0], $a);
          });

          $salvar = [];

          array_shift($data);

          foreach ($data as $item) {
            $salvar['password'] = Hash::make($item["﻿senha"]);
            $salvar['cpf'] = array_key_exists('cpf', $item) ?  $item['cpf'] : '';
            $salvar['rg'] = array_key_exists('rg', $item) ?  $item['rg'] : '';
            $salvar['email'] = $item['email'];
            $salvar['name'] = $item['name'];

            switch ($item['papel']) {
              case 'aluno':
              case 'Aluno':
                $salvar['papel_id'] = 2;
                break;

              case 'Preceptor':
              case 'preceptor':
              case 'Preceptores':
                $salvar['papel_id'] = 4;
                break;

              case 'tutor':
              case 'Tutor':
                $salvar['papel_id'] = 5;
                break;

              default:
                $salvar['papel_id'] = 2;
                break;
            }

            $user = new User();
            $user = User::create($salvar);

            $user->papeis()->attach($salvar['papel_id']);
          }

        }
      }
      return redirect()->back();
    }

}
