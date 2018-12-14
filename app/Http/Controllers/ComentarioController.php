<?php

namespace ProntuarioEletronico\Http\Controllers;

use Illuminate\Http\Request;
use Laravelista\Comments\CommentsController as CommentsController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ComentarioController extends CommentsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
         $this->validate($request, [
             'commentable_type' => 'required|string',
             'commentable_id' => 'required|integer|min:1',
             'message' => 'required|string'
         ]);

         $model = $request->commentable_type::findOrFail($request->commentable_id);

         $comment = new \Laravelista\Comments\Comment;
         $comment->commenter()->associate(auth()->user());
         $comment->commentable()->associate($model);
         $comment->comment = $request->message;
         $comment->local_atendimento = $request->local_atendimento;
         $comment->data_hora_atendimento =  date("Y-m-d H:i:s", strtotime($request->data_hora_atendimento));
         $comment->save();

         return redirect()->to(url()->previous() . '#comment-' . $comment->id);
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
