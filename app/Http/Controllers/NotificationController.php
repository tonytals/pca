<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificacoes(Request $request)
    {
        $notificaoesUser = $request->user()->notifications;

        return response()->json(compact('notificaoesUser'));
    }
}
