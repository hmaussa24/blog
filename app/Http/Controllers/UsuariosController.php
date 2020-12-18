<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    //
    public function getUsersAll(Request $request){
        return response()->json(['users' =>User::get()]);
    }

    public function getUsersByName(Request $request)
    {
        $user =   User::where('name', 'like', '%' . $request->buscar . '%')->get();
        return response()->json([
            "users" => $user,
        ]);
    }

    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)->delete();
        $users = User::get();
        return response()->json([
            "users" => $users,
        ]);
    }
}
