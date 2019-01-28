<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use ProntuarioEletronico\User;
use ProntuarioEletronico\Papel;
use Groups;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::denies('grupos-create')){
            abort(403,"Não autorizado!");
        }

        $data = [
          'name'              => Auth::user()->name . now(),
          'description'       => '', // optional
          'short_description' => '', // optional
          'image'             => '', // optional
          'private'           => 0,  // 0 (public) or 1 (private)
          'extra_info'        => '', // optional
          'settings'          => '', // optional
          'conversation_id'   => 0,  // optional if you want to add messaging to your groups this can be useful
        ];

        //$group = Groups::create(Auth::user()->id, $data);

        $user = Groups::getUser(2);

        //$user->groups[0]->addMembers([2]);

        //$group = Groups::group()>where('user_id', Auth::user()->id);
        dd($user->groups->first()->name);
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
        if(Gate::denies('grupos-create')){
            abort(403,"Não autorizado!");
        }

        $data = $request->all();

        $config = [
          'name'              => $data['name'],
          'description'       => $data['description'], // optional
          'short_description' => '', // optional
          'image'             => '', // optional
          'private'           => 0,  // 0 (public) or 1 (private)
          'extra_info'        => '', // optional
          'settings'          => '', // optional
          'conversation_id'   => 0,  // optional if you want to add messaging to your groups this can be useful
        ];

        $group = Groups::create($data['user_id'], $data);

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
        if(Gate::denies('grupos-show')){
            abort(403,"Não autorizado!");
        }

        $papelAluno = Papel::where('nome','Aluno')->first();

        $user = Groups::getUser($id);

        $grupo = $user->groups->first();

        $usuarios = User::whereHas('papeis', function ($query) use ($papelAluno) {
                $query->where("papel_user.papel_id", "=", $papelAluno->id);
        })->with('papeis')->get();


        return view('admin.grupos.detalhe', compact('usuarios','grupo'));
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
