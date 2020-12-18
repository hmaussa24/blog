<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function comentar(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string',
            'user_id' => 'required|integer',
            'slug' => 'required|string',

        ]);

        $post = Post::where('slug', $request->slug)->select('id')->get();
        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => $request->user_id,
            'post_id' => $post[0]['id']
        ]);
        $comen = Comentario::where('post_id', $post[0]['id'])->leftJoin('users', 'users.id', '=', 'comentarios.user_id')->orderByDesc('comentarios.created_at')->get();
        return response()->json([
            'message' => $post[0]['id'],
            'comentarios' => $comen
        ], 201);
    }


    public function getComentarioByPost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->select('id')->get();
        $comen = Comentario::where('post_id', $post[0]['id'])->leftJoin('users', 'users.id', '=', 'comentarios.user_id')->orderByDesc('comentarios.created_at')->get();
        return response()->json([
            'comentarios' => $comen
        ]);
    }

    public function numComentarios(Request $request){
        $numcomen = Comentario::where('post_id', $request->post_id)->count();
        return response()->json([
            "num" => $numcomen
        ]);
    }
}
