<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemSetorRequest;

use App\Models\ItemSetor;
use App\Models\Item;
use App\Models\Setor;

class ItemSetorController extends Controller
{
    public function readItemSetorIndex(){
        $setores = Setor::all();
        $itensSetor = ItemSetor::all();
        $itens = Item::all();
        return view('index', ['itensSetor' => $itensSetor, 'setores' => $setores, 'itens' => $itens]);
    }

    /**
     * Retorna a view de cadastro de item
     */
    public function cadastroItemSetor(){
        $itens = Item::all();
        $setores = Setor::all();
        
        return view('itemSetor/create', ['itens' => $itens, 'setores' => $setores]);
    }

    public function createItemSetor(ItemSetorRequest $request){
        $request->validated();

        ItemSetor::create([
            'setor_id' => $request->setor_id,
            'item_id' => $request->item_id,
            'qtd_estoque' => $request->qtd_estoque
        ]);
        
        return redirect()->route('index');
    }
}
