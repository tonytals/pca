<?php

namespace ProntuarioEletronico\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProntuarioEletronico\Http\Controllers\Controller;
use ProntuarioEletronico\User;
use ProntuarioEletronico\Papel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Groups;

class UnidadeDeSaudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Gate::denies('unidadesdesaude-index')){
          abort(403,"Não autorizado!");
      }

      $papelPreceptor = Papel::where('nome','Preceptor')->first();

      $usuarios = User::whereHas('papeis', function ($query) use ($papelPreceptor) {
              $query->where("papel_user.papel_id", "=", $papelPreceptor->id);
      })->with('papeis')->get();

      $preceptores = [];

      foreach ($usuarios as $preceptor) {
        $preceptores[] = Groups::getUser($preceptor->id);
      }

      return view('admin.unidades.index', compact('preceptores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $papelPreceptor = Papel::where('nome','Preceptor')->first();

        $usuarios = User::whereHas('papeis', function ($query) use ($papelPreceptor) {
                $query->where("papel_user.papel_id", "=", $papelPreceptor->id);
        })->with('papeis')->get();

        $preceptores = [];

        foreach ($usuarios as $preceptor) {
          $preceptores[] = Groups::getUser($preceptor->id);
        }

        return view('admin.unidades.form', compact('preceptores'));
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
