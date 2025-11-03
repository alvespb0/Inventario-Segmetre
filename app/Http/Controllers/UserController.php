<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setor;

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
        $setores = Setor::all();
        return view("usuarios/create", ['setores'=> $setores]);
    }

    public function createUsuario(UserRegisterRequest $request){
        $request->validated();

        User::create([
            'login' => $request->login,
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'setor_id' => $request->setor_id,
            'is_administrator' => $request->is_administrator
        ]);

        return redirect()->route('usuarios.show');
    }


}
