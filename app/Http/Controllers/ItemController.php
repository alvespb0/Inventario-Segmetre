<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Retorna a view de listagem de itens cadastrados
     */
    public function readItens(){
        $itens = Item::all();
        return view('/itens/index', ['itens' => $itens]);
    }

    /**
     * Retorna a view de cadastro de item
     */
    public function cadastroItem(){
        return view('/itens/create');
    }

    /**
     * Salva o item no banco
     * @param Request $request
     * @return Redirect itens.show
     */
    public function createItem(Request $request){
        Item::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        session()->flash('mensagem', 'Item cadastrado com sucesso');

        return redirect()->route('itens.show');
    }

    /**
     * retorna a view de editar Item
     */
    public function editarItem($id){
        $item = Item::findOrFail($id);

        return view('/itens/update', ['item' => $item]);
    }

    /**
     * Edita o item no banco
     * @param Request $request
     * @return Redirect itens.show
     */
    public function updateItem(Request $request, $id){
        $item = Item::findOrFail($id);

        $item->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        session()->flash('mensagem', 'Item atualizado com sucesso');

        return redirect()->route('itens.show');
    }

    public function deleteItem($id){
        $item = Item::findOrFail($id);

        $item->delete();

        session()->flash('mensagem', 'Item excluído com sucesso');

        return redirect()->route('itens.show');
    }
}
