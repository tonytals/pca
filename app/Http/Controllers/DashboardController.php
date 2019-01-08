<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\User;
use ProntuarioEletronico\Agendamento;
use Illuminate\Support\Facades\Auth;
use Laravelista\Comments\Comment;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function index()
    {

        //dd(Auth::user()->papeis[0]->nome);
        switch (Auth::user()->papeis[0]->nome) {
          case 'Aluno':
            return redirect()->action('DashboardController@dashboardAluno');
            break;

          case 'Tutor':
            return redirect()->action('DashboardController@dashboardTutor');
            break;

          default:
            return redirect()->action('DashboardController@dashboardAluno');
            break;
        }

    }

    public function dashboardAluno()
    {
      if(Gate::denies('dashboard-aluno')){
        abort(403,"Não autorizado!");
      }

      $user_id = Auth::user()->id;

      $usuarios = new User();
      $pacientes = $usuarios->getPacientes($user_id);
      $quantidade_pacientes = count($pacientes[0]->pacientes);

      $comentarios = new Comment();
      $quantidade_comentarios = $comentarios::all()->where('commenter_id', $user_id)->count();

      $locais_atendimento = $comentarios::all()->where('commenter_id', $user_id)->groupBy('local_atendimento');

      $agenda = new Agendamento();
      $agenda = $agenda::all()->where('user_id', $user_id);

      $notificacoes = Auth::user()->unreadNotifications;
      $notificacaoAgenda = [];

      foreach ($agenda as $notificacao) {
        $notificacaoAgenda['agenda'] = $notificacao;
        $idPaciente = $notificacao->getOriginal('paciente_id');

        foreach ($notificacoes as $item) {

          if($item->data['comentario']['commentable_id'] == $idPaciente){
            $notificacaoAgenda['agenda']['notificacao'] = $item->data['comentario'];
          };

        }

      }


      dd($notificacaoAgenda);
      dd($agenda);

      return view('dashboardAluno',compact('quantidade_pacientes','quantidade_comentarios','locais_atendimento','agenda'));

    }

    public function dashboardTutor()
    {
      if(Gate::denies('dashboard-tutor')){
        abort(403,"Não autorizado!");
      }
      return view('dashboardTutor');
    }
}
