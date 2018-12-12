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

        //$usuarios = User::all();
        $usuarios = User::select('id','name','cpf','email')->with('papeis:nome')->get();

        return view('admin.usuarios.index',compact('usuarios','tituloColunas'));
    }

    public function papel($id)
    {
      if(Gate::denies('usuario-edit')){
        abort(403,"Não autorizado!");
      }

      $usuario = User::find($id);
      $papel = Papel::all();

      return view('admin.usuarios.papel',compact('usuario','papel'));
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

      return redirect()->back();
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
    }

    public function adicionar()
    {
      if(Gate::denies('usuario-create')){
          abort(403,"Não autorizado!");
      }

      $papel = Papel::all();

      return view('admin.usuarios.form',compact('papel'));
    }

    

}
