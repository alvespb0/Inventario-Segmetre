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

    /**
     * Salva o usuário no banco
     * @param UserRegisterRequest $request
     * @return redirect 
     */
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
        
        session()->flash('mensagem', 'Usuário cadastrado com sucesso!');

        return redirect()->route('usuarios.show');
    }

    /**
     * Localiza o usuario via findOrFail ID se localizado retorna a view de update
     * @param int $id
     * @return view
     */
    public function editarUsuario($id){
        $usuario = User::findOrFail($id);
        $setores = Setor::all();
        return view("/usuarios/update", ['usuario' => $usuario, 'setores' => $setores]);
    }

    /**
     * Da update no usuario dado a mesma request de register
     * @param UserRegisterRequest $request
     * @return Redirect()
     */
    public function updateUsuario(UserRegisterRequest $request, $id){
        $request->validated();

        $usuario = User::findOrFail($id);

        $usuario->update([
            'login' => $request->login,
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'setor_id' => $request->setor_id,
            'is_administrator' => $request->is_administrator
        ]);

        session()->flash('mensagem', 'Usuário atualizado com sucesso!');

        return redirect()->route('usuarios.show');
    }

    public function deleteUsuario($id){
        $usuario = User::findOrFail($id);
        $usuario->delete();

        session()->flash('mensagem', 'Usuário excluído com sucesso!');

        return redirect()->route('usuarios.show');
    }
    /**
     * Retorna a view de login
     */
    public function login(){
        return view('/auth/login');
    }
    
    /**
     * Verifica se o login input é email ou login para definir o campo definido o campo faz login via Auth::attempt
     * @param Request $request
     * @return Redirect Route
     */
    public function tryLogin(Request $request){
        $loginInput = $request->login; 

        $campo = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if (Auth::attempt([$campo => $loginInput, 'password' => $request->senha])) {
            session()->flash('mensagem', 'Login realizado com sucesso!');
            return redirect()->route('index');
        }

        session()->flash('error', 'Credenciais inválidas!');
        return redirect()->route('login.show');
    }

    /**
     * Faz logout
     */
    public function logout(){
        Auth::logout();

        return redirect()->route('login.show');
    }
}
