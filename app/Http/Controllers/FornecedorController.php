<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Http\Requests\FornecedorRequest;

class FornecedorController extends Controller
{
    /**
     * Retorna a view de listagem de fornecedores
     */
    public function readFornecedores(){
        $fornecedores = Fornecedor::all();
        return view('/fornecedores/index', ['fornecedores' => $fornecedores]);
    }

    /**
     * Retorna a view de cadastro de fornecedor
     */
    public function cadastroFornecedor(){
        return view('/fornecedores/create');
    }

    /**
     * Salva o fornecedor no banco
     * @param FornecedorRequest $request
     * @return redirect 
     */
    public function createFornecedor(FornecedorRequest $request){
        $request->validated();

        Fornecedor::create([
            'cnpj' => $request->cnpj,
            'nome' => $request->nome,
            'cliente_segmetre' => $request->cliente_segmetre
        ]);

        session()->flash('mensagem', 'Fornecedor Cadastrado com sucesso');

        return redirect()->route('fornecedores.show');
    }

    /**
     * Localiza o fornecedor via findOrFail ID se localizado retorna a view de update
     * @param int $id
     * @return view
     */
    public function editarFornecedor($id){
        $fornecedor = Fornecedor::findOrFail($id);
        return view('/fornecedores/update', ['fornecedor' => $fornecedor]);
    }

    /**
     * Da update no fornecedor dado a mesma request de register
     * @param FornecedorRequest $request
     * @return Redirect()
     */
    public function updateFornecedor(FornecedorRequest $request, $id){
        $request->validated();

        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->update([
            'cnpj' => $request->cnpj,
            'nome' => $request->nome,
            'cliente_segmetre' => $request->cliente_segmetre            
        ]);

        session()->flash('mensagem', 'Fornecedor atualizado com sucesso');

        return redirect()->route('fornecedores.show');
    }

    public function deleteFornecedor($id){
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->delete();

        session()->flash('mensagem', 'Fornecedor excluído com sucesso');

        return redirect()->route('fornecedores.show');

    }
}
