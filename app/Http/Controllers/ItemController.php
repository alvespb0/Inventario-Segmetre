<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemFornecedor;
use App\Models\Fornecedor;
use Illuminate\Support\Arr;

class ItemController extends Controller
{
    /**
     * Retorna a view de listagem de itens cadastrados
     */
    public function readItens(){
        $itens = Item::orderBy('nome', 'asc')->paginate(5);
        return view('/itens/index', ['itens' => $itens]);
    }

    /**
     * Retorna a view de cadastro de item
     */
    public function cadastroItem(){
        $fornecedores = Fornecedor::all();
        return view('/itens/create', ['fornecedores' => $fornecedores]);
    }

    /**
     * Salva o item no banco
     * @param Request $request
     * @return Redirect itens.show
     */
    public function createItem(Request $request){
        $item = Item::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        $fornecedores = Arr::wrap($request->fornecedores);

        foreach($fornecedores as $fornecedor){
            if ($fornecedor) { // evita criar se vier vazio
                ItemFornecedor::create([
                    'item_id' => $item->id,
                    'fornecedor_id' => $fornecedor,
                    'valor_unitario' => null
                ]);
            }
        }

        session()->flash('mensagem', 'Item cadastrado com sucesso');

        return redirect()->route('itens.show');
    }

    /**
     * retorna a view de editar Item
     */
    public function editarItem($id){
        $item = Item::findOrFail($id);
        $fornecedores = Fornecedor::all();
        $fornecedoresSelecionados = $item->itemFornecedor->pluck('fornecedor_id')->toArray();
        return view('/itens/update', ['item' => $item, 'fornecedores' => $fornecedores, 'fornecedoresSelecionados' => $fornecedoresSelecionados]);
    }

    /**
     * Edita o item no banco
     * @param Request $request
     * @return Redirect itens.show
     */
    public function updateItem(Request $request, $id){
        $item = Item::findOrFail($id);

        $itemFornecedor = $item->itemFornecedor()->delete();

        $item->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        $fornecedores = Arr::wrap($request->fornecedores);

        foreach($fornecedores as $fornecedor){
            if ($fornecedor) { 
                ItemFornecedor::create([
                    'item_id' => $item->id,
                    'fornecedor_id' => $fornecedor,
                    'valor_unitario' => null
                ]);
            }
        }
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
