<?php

namespace App\Services;

use Carbon\Carbon;

use App\Models\User;

use App\Exports\SolicitacaoExport;
use App\Exports\FornecedorExport;
use App\Exports\EstoqueExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class RelatorioDiarioService
{
    private function gerarSolicitacaoExport(){
        $fileName = 'relatorio_solicitacoes_'.now()->format('Y-m-d').'.xlsx';

        $hoje = Carbon::now();
        $filtros = [ # tem que ser array, o construtor da export pede um array
            'dataInicio' => $hoje->subDays(30),
            'dataFim' => $hoje
        ];

        Excel::store(new SolicitacaoExport($filtros), "relatorios/$fileName");

        return $fileName;
    }

    private function gerarEstoqueExport(){
        $fileName = 'relatorio_estoque_'.now()->format('Y-m-d').'.xlsx';

        $filtros = []; # tem que ser array, o construtor da export pede um array

        Excel::store(new EstoqueExport($filtros), "relatorios/$fileName");

        return $fileName;
    }

    private function gerarFornecedorExport(){
        $fileName = 'relatorio_fprnecedores_'.now()->format('Y-m-d').'.xlsx';

        $hoje = Carbon::now();

        $filtros = []; # tem que ser array, o construtor da export pede um array

        Excel::store(new FornecedorExport($filtros), "relatorios/$fileName");

        return $fileName;
    }

    public function gerarRelatorios(){
        $fileNames = [
            'solicitacoes' => $this->gerarSolicitacaoExport(),
            'estoque' => $this->gerarEstoqueExport(),
            'fornecedores' => $this->gerarFornecedorExport()
        ];

        return $fileNames;
    }

    public function getAdministradores(){
        return User::where('is_administrator', true)->get();
    }

}

?>