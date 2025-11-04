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

    public function createItem(Request $request){
        Item::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ]);

        session()->flash('mensagem', 'Item cadastrado com sucesso');

        return redirect()->route('itens.show');
    }

}
