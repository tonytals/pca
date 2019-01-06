<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use ProntuarioEletronico\Agendamento;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $events = Agendamento::all()->where('user_id', Auth::user()->id);
      $event = [];
      foreach($events as $row){
          $data_fim = $row->data_fim != null ? $row->data_fim : $row->data_inicio;
          $event[] = \Calendar::event(
          $row->paciente_id,
          true,
          $row->data_inicio,
          $data_fim,
          $row->id,
            [
              'color' => '#336699',
              'description' => $row->observacao,
            ]
          );
      }
      $calendar = \Calendar::addEvents($event)->setOptions([ 'lang' => 'pt-br' ])
                                              ->setCallbacks([
                                        'eventRender' => 'function(event, element) {
                                                                  element.popover({
                                                                      title: "Observações",
                                                                      content: event.description,
                                                                      trigger: "hover",
                                                                      placement: "top",
                                                                      container: "body"
                                                                    })
                                                            }',
                                        'eventClick' => 'function(event, element, view) {
                                            swal({
                                                title: "Tem certeza?",
                                                text: "Deletar essa agenda é uma ação irreversível!",
                                                type: "warning",
                                                cancelButtonText: "Cancelar",
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Sim, deletar!",
                                                closeOnConfirm: false
                                            }, function () {
                                                $.ajax({
                                                     type: "delete",
                                                     url: "/agendamentos/delete/"+event.id,
                                                     data: {_method: "delete", _token: "'.csrf_token().'" },
                                                     success: function (data) {
                                                         location.reload();
                                                     },
                                                     error: function (data) {
                                                         location.reload();
                                                     }
                                                 });
                                            });

                                        }']);

      return view('agendamentos.index', compact('calendar','events'));
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
        $data = $request->all();

        $data['data_inicio'] = Date::parse($data['data_inicio'])->format('Y-m-d H:m:s');

        $agenda = new Agendamento();
        $agenda = Agendamento::create($data);

        return back()->with('sucesso', 'Criado Com Sucesso');;
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
        Agendamento::find($id)->delete();
        return back();
    }
}
