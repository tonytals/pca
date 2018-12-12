<?php

namespace ProntuarioEletronico\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ProntuarioEletronico\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
      if(Gate::denies('admin-view')){
        abort(403,"Não autorizado!");
      }

      return view('admin.index');
    }
}
