<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
{
    /**
     * Retorna a view de listagem de setores
     */
    public function readSetor(){
        $setores = Setor::all();
        return view("setores/index", ['setores' => $setores]);
    }

    /**
     * Retorna a view de listagem de setores dado uma request
     */
    public function filterSetor(Request $request){
        $setores = Setor::where('nome', 'LIKE', "%{$request->busca}%")->get();
        return view("setores/index", ['setores' => $setores]);
    }
    /**
     * Retorna a view de cadastro de setor
     */
    public function cadastroSetor(){
        return view("setores/create");
    }

    /**
     * Salva o setor no banco
     * @param Request $request
     * @return Redirect setores.show
     */
    public function createSetor(Request $request){
        Setor::create([
            'nome' => $request->nome
        ]);

        session()->flash('mensagem', 'Setor cadastrado com sucesso');
        
        return redirect()->route('setores.show');
    }

    /**
     * Retorna a view de editar setor
     */
    public function editarSetor($id){
        $setor = Setor::findOrFail($id);

        return view('/setores/update', ['setor' => $setor]);
    }

    /**
     * Edita o setor no banco
     * @param Request $request
     * @return Redirect setores.show
     */
    public function updateSetor(Request $request){
        $setor = Setor::findOrFail($request->setor_id);

        $setor->update([
            'nome' => $request->nome
        ]);

        return redirect()->route('setores.show');
    }

    public function deleteSetor(Request $request){
        $setor = Setor::findOrFail($request->setor_id);

        $setor->delete();

        return redirect()->route('setores.show');
    }
}
