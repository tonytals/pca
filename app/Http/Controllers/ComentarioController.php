<?php

namespace ProntuarioEletronico\Http\Controllers;

use ProntuarioEletronico\Notifications\ProntuarioCommented;
use Illuminate\Http\Request;
use Laravelista\Comments\CommentsController as CommentsController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use ProntuarioEletronico\User;

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

         $detail = $request->input('message');
         $dom = new \DomDocument();
         $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
         $images = $dom->getElementsByTagName('img');

         foreach($images as $k => $img){
           $data = $img->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $data = base64_decode($data);
           $image_name= "/upload/" . time().$k.'.png';
           $path = public_path() . $image_name;
           file_put_contents($path, $data);
           $img->removeAttribute('src');
           $img->setAttribute('src', $image_name);
         }

         $detail = $dom->saveHTML();

         $comment = new \Laravelista\Comments\Comment;
         $comment->commenter()->associate(auth()->user());
         $comment->commentable()->associate($model);
         $comment->local_atendimento = $request->local_atendimento;
         $comment->data_hora_atendimento =  date("Y-m-d H:i:s", strtotime($request->data_hora_atendimento));
         $comment->comment = $detail;
         $comment->save();

         $avisar = new user();
         $avisar = $avisar->all()->where('turma', auth()->user()->turma);

         foreach ($avisar as $key => $tutor) {
           if (isset($tutor->papeis[$key]->nome) && $tutor->papeis[$key]->nome == 'Tutor') {
             $tutor->notify(new ProntuarioCommented($comment));
           }
         }

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
     public function update(Request $request, \Laravelista\Comments\Comment $comment)
     {
         $this->authorize('edit-comment', $comment);

         $this->validate($request, [
             'message' => 'required|string'
         ]);

         $comment->update([
             'comment' => $request->message,
             'comment' => $request->local_atendimento,
             'comment' => $request->data_hora_atendimento
         ]);

         return redirect()->to(url()->previous() . '#comment-' . $comment->id);
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

    public function reply(Request $request, \Laravelista\Comments\Comment $comment)
    {

        $this->validate($request, [
            'message' => 'required|string'
        ]);

        $reply = new \Laravelista\Comments\Comment;
        $reply->commenter()->associate(auth()->user());
        $reply->commentable()->associate($comment->commentable);
        $reply->parent()->associate($comment);
        $reply->comment = $request->message;
        $reply->save();

        /*
         * NOTIFICAÇÕES
         */
        $author = $reply->commenter()->associate(auth()->user())->parent->commenter;
        $author->notify(new ProntuarioCommented($reply));

        return redirect()->to(url()->previous() . '#comment-' . $reply->id);
    }
}
