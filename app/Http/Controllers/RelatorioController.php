<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use App\Models\Fornecedor;
class RelatorioController extends Controller
{
    public function parametrizarRelatorio(){
        $setores = Setor::all();
        $fornecedores = Fornecedor::all();
        return view('relatorios/index', ['setores' => $setores, 'fornecedores' => $fornecedores]);
    }

    public function gerarRelatorio(Request $request){
        $tipo = $request->tipoRelatorio;
        
        switch($tipo){
            case 'solicitacao':
                $filtros = [
                    'setor' => $request->setorSolicitacao,
                    'dataInicio' => $request->dataInicialSolicitacao,
                    'dataFim' => $request->dataFinalSolicitacao,
                    'status' => $request->statusSolicitacao
                ];

                break;
            case 'itens_fornecedores':
                $filtros = [
                    'nomeItem' => $request->nomeItem,
                    'fornecedorId' => $request->fornecedor,
                ];
                break;
            case 'estoque':
                $filtros = [
                    'setor' => $request->setorEstoque,
                    'tolerancia' => $request->limiteTolerancia,
                    'nomeItem' => $request->nomeItemEstoque
                ];
                break;

        }
    }

}
