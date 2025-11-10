<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoItem;
use App\Models\Item;
use App\Models\Setor;

class SolicitacaoItemController extends Controller
{
    /**
     * Retorna a view de listagem de solicitações GERAL 
     * Somente para admins
     */
    public function readSolicitacoesGeral(){
        $solicitacoes = SolicitacaoItem::orderBy('data_solicitacao', 'desc')->paginate(5);
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Retorna a view de listagem de solicitações dado um setor_id
     */
    public function readSolicitacoesSetor($setor_id){
        $solicitacoes = SolicitacaoItem::where('setor_id', $setor_id)->paginate(5);
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Retorna a view decadastro de solicitação
     */
    public function cadastroSolicitacao(){
        $setores = Setor::all();
        $itens = Item::orderBy('nome', 'asc')->get();

        return view('/solicitacoes/create', ['itens' => $itens, 'setores' => $setores]);
    }

}
