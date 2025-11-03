<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Retorna a view de listagem de usuarios
     */
    public function readUsuarios(){
        $usuarios = User::all();
        return view("usuarios/index", ['usuarios' => $usuarios]);
    }

    /**
     * Retorna a view de cadastro de usuário 
     */
    public function cadastroUsuario(){
        return view("usuarios/create");
    }
}
