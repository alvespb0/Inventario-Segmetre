<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Models\SolicitacaoItem;

class SolicitacaoExport implements FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles, 
    WithColumnWidths, 
    ShouldAutoSize,
    WithTitle,
    WithEvents
{
    protected $filtros;

    public function __construct(array $filtros)
    {
        $this->filtros = $filtros;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = SolicitacaoItem::query();

        if(!empty($this->filtros['setor'])){
            $query->where('setor_id', $this->filtros['setor']);
        }

        if(!empty($this->filtros['dataInicio'])){
            $query->where('data_solicitacao', '>', $this->filtros['dataInicio']);
        }

        if(!empty($this->filtros['dataFim'])){
            $query->where('data_solicitacao', '<', $this->filtros['dataFim']);
        }

        if(!empty($this->filtros['status'])){
            $query->where('status', $this->filtros['status']);
        }

        return $query->get();
    }

    public function map($solicitacaoItem): array{
        return [
            $solicitacaoItem->id,
            $solicitacaoItem->setor->nome,
            $solicitacaoItem->item->nome,
            $solicitacaoItem->item->descricao ?? 'N/A',
            $solicitacaoItem->quantidade,
            $solicitacaoItem->observacao ?? 'N/A',
            $solicitacaoItem->status,
            $solicitacaoItem->data_solicitacao,
            $solicitacaoItem->item->getParceiroMaisBaratoAttribute(),
            'R$'.$solicitacaoItem->item->getMenorValorParceiroAttribute(),
            $solicitacaoItem->item->getFornecedorMaisBaratoAttribute(),
            $solicitacaoItem->item->getMenorValorUnitarioAttribute()
        ];
    }

    public function headings(): array{
        return [
            'ID',
            'Setor',
            'Item',
            'Descrição',
            'Qtd Solicitada',
            'Observacao',
            'Status',
            'Data de Solicitacao',
            'Fornecedor Parceiro Recomendado',
            'Valor Unitário do Fornecedor',
            'Fornecedor Mais Barato',
            'Valor Unitário do Fornecedor'
        ];
    }
    public function styles(Worksheet $sheet){
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '034078']
            ]],
        ];
    }

    public function columnWidths(): array{
        return [
            'A' => 6,
            'B' => 30,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 40,
            'J' => 20,
            'K' => 40,
            'L' => 20,
        ];
    }

    public function title(): string
    {
        return 'Relatório de Solicitacao';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestCol = $sheet->getHighestColumn();

                // Cria bordas em toda a tabela
                $sheet->getStyle("A1:{$highestCol}{$highestRow}")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Ajusta alinhamento
                $sheet->getStyle("A1:{$highestCol}{$highestRow}")
                    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                // Transforma em tabela formatada
                $event->sheet->getDelegate()->setAutoFilter("A1:{$highestCol}1");
            },
        ];
    }

}
