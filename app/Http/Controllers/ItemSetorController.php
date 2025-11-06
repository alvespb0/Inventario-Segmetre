<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemSetorRequest;

use App\Models\ItemSetor;
use App\Models\Item;
use App\Models\Setor;

class ItemSetorController extends Controller
{
    /**
     * Retorna a view index do sistema
     */
    public function readItemSetorIndex(){
        $setores = Setor::all();
        $itensSetor = ItemSetor::all();
        $itens = Item::all();
        return view('index', ['itensSetor' => $itensSetor, 'setores' => $setores, 'itens' => $itens]);
    }

    /**
     * Retorna a view que traz os itens já cadastrados naquele setor, além da tabulação para alterar a quantidade em estoque
     */
    public function readItemSetor($setor_id){
        $itensSetor = ItemSetor::where('setor_id', $setor_id)->get();

        return view('/itemSetor/index', ['itensSetor' => $itensSetor]);
    }

    /**
     * Retorna a view de cadastro de item
     */
    public function cadastroItemSetor(){
        $itens = Item::all();
        $setores = Setor::all();
        return view('itemSetor/create', ['itens' => $itens, 'setores' => $setores]);
    }

    /**
     * Salva o itemSetor no banco
     * @param ItemSetorRequest $request
     * @return redirect index
     */
    public function createItemSetor(ItemSetorRequest $request){
        $request->validated();

        ItemSetor::create([
            'setor_id' => $request->setor_id,
            'item_id' => $request->item_id,
            'qtd_estoque' => $request->qtd_estoque
        ]);
        
        return redirect()->route('index');
    }

    /**
     * Atualiza o item em estoque no banco
     * @param Request $request
     * @return redirect back
     */
    public function updateQtdEstoque(Request $request){
        $item = ItemSetor::findOrFail($request->itemSetor_id);

        $item->update([
            'qtd_estoque' => $request->qtd_estoque
        ]);

        session()->flash('mensagem', 'Quantidade em estoque atualizado com sucesso');
        
        return redirect()->back();
    }

    public function deleteItemSetor(Request $request){
        $item = ItemSetor::findOrFail($request->itemSetor_id);

        $item->delete();

        session()->flash('mensagem', 'Item Excluído com sucesso');
        
        return redirect()->back();
    }
}
