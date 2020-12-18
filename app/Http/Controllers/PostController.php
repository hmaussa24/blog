<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function uploadFoto(Request $request)
    {
        $id = Post::latest('id')->first();
        if ($request->hasFile('foto')) {
            $file = $request->file("foto");
            $nombrearchivo  = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("img/"), $nombrearchivo);
            Post::where('id', $id->id)->update(['imagen' => $nombrearchivo]);
            return response()->json([
                'message' => true,
                //'id' => $id,
            ], 201);
        } else {
            return response()->json([
                'message' => false,
            ], 406);
        }
    }

    public function postCategori()
    {
        return response()->json(Categoria::get());
    }


    function createSlug($str, $max = 30)
    {
        $out = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $out = substr(preg_replace("/[^-\/+|\w ]/", '', $out), 0, $max);
        $out = strtolower(trim($out, '-'));
        $out = preg_replace("/[\/_| -]+/", '-', $out);

        return $out;
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'texto_largo' => 'required|string',
            'texto_corto' => 'required|string',
            'categoria' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'texto_largo' => $request->texto_largo,
            'texto_corto' => $request->texto_corto,
            'categoria_id' => $request->categoria,
            'user_id' => $request->user_id,
            'slug' => $this->createSlug($request->titulo),
            'imagen' => ""
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function getPostsById(Request $request)
    {
        $post = Post::where('user_id', $request->id)->get();
        return response()->json([
            "posts" => $post,
        ]);
    }

    public function getPostsAll(Request $request)
    {
        $post = Post::get();
        return response()->json([
            "posts" => $post,
        ]);
    }

    public function deletePost(Request $request)
    {
        Post::where('id', $request->id)->delete();
        $post = Post::get();
        return response()->json([
            "posts" => $post,
        ]);
    }

    public function getPostByText(Request $request)
    {
        $post =   Post::where('titulo', 'like', '%' . $request->buscar . '%')->get();
        return response()->json([
            "posts" => $post,
        ]);
    }

    public function getPostBySlug(Request $request)
    {
        $post = Post::where('slug', $request->slug)->get();
        return response()->json([
            "posts" => $post,
        ]);
    }

    public function deleteCat(Request $request)
    {
        Categoria::where('id', $request->id)->delete();
        return response()->json(Categoria::get());
    }

    public function addCat (Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        Categoria::create([
            'name' => $request->name,
        ]);

        return response()->json(Categoria::get());
    }
}
