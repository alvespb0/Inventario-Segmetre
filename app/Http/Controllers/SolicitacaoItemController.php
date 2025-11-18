<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolicitacaoItemRequest;

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
        $setores = Setor::all();
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes, 'setores' => $setores]);
    }

    /**
     * Filtro de solicitações geral, para usuários admin
     * @param Request $request
     */
    public function filterSolicitacoesGeral(Request $request){
        $query = SolicitacaoItem::query();
        $setores = Setor::all();

        if(!empty($request->busca)){
            $busca = $request->busca;
            $query->whereHas('item', function ($q) use ($busca){
                $q->where('nome', 'LIKE', "%{$busca}%");
            });
        }

        if(!empty($request->setor)){
            $query->where('setor_id', $request->setor);
        }

        if(!empty($request->status)){
            $query->where('status', $request->status);
        }

        if(!empty($request->status)){
            $query->where('status', $request->status);
        }

        if(!empty($request->dataInicialSolicitacao)){
            $query->where('data_solicitacao', '>', $request->dataInicialSolicitacao);
        }

        if(!empty($request->dataFinalSolicitacao)){
            $query->where('data_solicitacao', '<', $request->dataFinalSolicitacao);
        }
      
        $solicitacoes = $query->orderBy('data_solicitacao', 'desc')->paginate(5)->appends($request->query());;
    
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes, 'setores' => $setores]);
    }

    /**
     * Filtro de solicitações do setor, para usuários não admin
     * @param Request $request
     */
    public function filterSolicitacoesSetor(Request $request){
        $query = SolicitacaoItem::query();
        $setores = Setor::all();

        if(!empty($request->busca)){
            $busca = $request->busca;
            $query->whereHas('item', function ($q) use ($busca){
                $q->where('nome', 'LIKE', "%{$busca}%");
            });
        }

        if(!empty($request->status)){
            $query->where('status', $request->status);
        }

        if(!empty($request->status)){
            $query->where('status', $request->status);
        }

        if(!empty($request->dataInicialSolicitacao)){
            $query->where('data_solicitacao', '>', $request->dataInicialSolicitacao);
        }

        if(!empty($request->dataFinalSolicitacao)){
            $query->where('data_solicitacao', '<', $request->dataFinalSolicitacao);
        }
    
        $solicitacoes = $query->where('setor_id', $request->setor_id)
                            ->orderBy('data_solicitacao', 'desc')
                            ->paginate(5)->appends($request->query());;
    
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes, 'setores' => $setores]);
    }

    /**
     * Retorna a view de listagem de solicitações dado um setor_id
     */
    public function readSolicitacoesSetor($setor_id){
        $solicitacoes = SolicitacaoItem::where('setor_id', $setor_id)->paginate(5);
        $setores = Setor::all();
        return view('/solicitacoes/index', ['solicitacoes' => $solicitacoes, 'setores' => $setores]);
    }

    /**
     * Retorna a view decadastro de solicitação
     */
    public function cadastroSolicitacao(){
        $setores = Setor::all();
        $itens = Item::orderBy('nome', 'asc')->get();

        return view('/solicitacoes/create', ['itens' => $itens, 'setores' => $setores]);
    }

    /**
     * Valida a request via SolicitacaoItemRequest e salva no banco
     * @param SolicitacaoItemRequest $request
     */
    public function createSolicitacao(SolicitacaoItemRequest $request){
        $request->validated();

        SolicitacaoItem::create([
            'setor_id' => $request->setor_id,
            'item_id' => $request->item_id,
            'quantidade' => $request->qtd,
            'data_solicitacao' => $request->data_solicitacao,
            'observacao' => $request->observacoes ?? null
        ]);

        session()->flash('mensagem', 'Solicitação criada com sucesso');

        return redirect()->route('index');
    }

    /**
     * Dá update no status, somente para administradores
     * @param Request $request
     * @param int $id
     * @return redirect() back
     */
    public function updateStatus(Request $request, $id){
        $solicitacao = SolicitacaoItem::findOrFail($id);
        
        $solicitacao->update([
            'status' => $request->status
        ]);

        session()->flash('mensagem', 'Status alterado com sucesso');
        
        return redirect()->back();
    }

    public function deleteStatus($id){
        $solicitacao = SolicitacaoItem::findOrFail($id);

        $solicitacao->delete();

        session()->flash('mensagem', 'Solicitação excluída com sucesso');
        
        return redirect()->back();
    }
}
