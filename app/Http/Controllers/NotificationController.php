<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificacoes(Request $request)
    {
        $notificaoesUser = $request->user()->unreadNotifications;

        return response()->json(compact('notificaoesUser'));
    }

    public function markAsRead(Request $request)
    {
        $notificacao = $request->user()->notifications
                                           ->where('id', $request->id)
                                           ->first();

        if($notificacao)
           $notificacao->markAsRead();

    }
}
