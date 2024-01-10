<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Post;

class CommentsController extends Controller
{
    //
    public function store(Post $post, CommentStoreRequest $request)
    {
        /* $data = $request->all();
         $data['post_id'] = $post->id;

         Comment::create($data);*/

        /*$post->comments()->create($request->all());*/
        $post->createComment($request->all());

        return redirect()->back()->with('message', "O teu comentário foi enviado com sucesso!");
    }
}
