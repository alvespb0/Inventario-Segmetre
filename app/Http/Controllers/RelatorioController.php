<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Setor;
use App\Models\Fornecedor;


use App\Exports\EstoqueExport;
use App\Exports\SolicitacaoExport;
use App\Exports\FornecedorExport;

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

                return Excel::download(new SolicitacaoExport($filtros), 'relatorio_solicitacao.xlsx');
                break;
            case 'itens_fornecedores':
                $filtros = [
                    'nomeItem' => $request->nomeItem,
                    'fornecedorId' => $request->fornecedor,
                ];

                return Excel::download(new FornecedorExport($filtros), 'relatorio_fornecedores.xlsx');
                break;
            case 'estoque':
                $filtros = [
                    'setor' => $request->setorEstoque,
                    'tolerancia' => $request->limiteTolerancia,
                    'nomeItem' => $request->nomeItemEstoque
                ];

                return Excel::download(new EstoqueExport($filtros), 'relatorio_estoque.xlsx');
                break;

        }
    }

}
