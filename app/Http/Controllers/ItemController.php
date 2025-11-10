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
     * Retorna a view de listagem de itens dado uma request
     */
    public function filterItens(Request $request){
        $itens = Item::where('nome', 'like', '%'.$request->busca.'%')
                    ->orWhere('descricao', 'like', '%'.$request->busca.'%')
                    ->orderBy('nome', 'asc')
                    ->paginate(5)->appends($request->query());

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

        $item->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        $fornecedoresNovos = Arr::wrap($request->fornecedores);
        $fornecedoresAtuais = $item->itemFornecedor->pluck('fornecedor_id')->toArray();

        $adicionar = array_diff($fornecedoresNovos, $fornecedoresAtuais);
        $remover = array_diff($fornecedoresAtuais, $fornecedoresNovos);

        foreach($adicionar as $fornecedorId){
            ItemFornecedor::create([
                'item_id' => $item->id,
                'fornecedor_id' => $fornecedorId,
                'valor_unitario' => null
            ]);
        }

        if (!empty($remover)) {
            ItemFornecedor::where('item_id', $item->id)
                ->whereIn('fornecedor_id', $remover)
                ->delete();
        }

        session()->flash('mensagem', 'Item atualizado com sucesso');

        return redirect()->route('itens.show');
    }

    /**
     * Deleta o item no banco
     */
    public function deleteItem($id){
        $item = Item::findOrFail($id);

        $item->delete();

        session()->flash('mensagem', 'Item excluído com sucesso');

        return redirect()->route('itens.show');
    }

    /**
     * Retorna a view de tabela de preço dos fornecedores
     * Recebe um id de ITEM e faz um where item_id id
     * @param $id
     * @return view
     */
    public function tabelaPrecoItemFornecedor($id){
        $itemFornecedor = ItemFornecedor::where('item_id', $id)->get();

        return view('itens/updateTabela', ['itemFornecedor' => $itemFornecedor]);
    }

    public function updateValorUnitario(Request $request){
        $itemFornecedor = ItemFornecedor::findOrFail($request->itemFornecedor_id);

        $itemFornecedor->update([
            'valor_unitario' => $request->valor_unitario
        ]);

        session()->flash('mensagem', 'Valor unitário atualizado com sucesso');
        
        return redirect()->back();
    }
}
