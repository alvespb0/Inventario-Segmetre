<?php

namespace App\Exports;

use App\Models\ItemFornecedor;

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

class FornecedorExport implements FromCollection, 
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
        $query = ItemFornecedor::query();

        if(!empty($this->filtros['nomeItem'])){
            $busca = $this->filtros['nomeItem'];

            $query->whereHas('item', function ($q) use ($busca) {
                $q->where('nome', 'LIKE', "%{$busca}%");
            });
        }

        if(!empty($this->filtros['fornecedorId'])){
            $query->where('fornecedor_id', $this->filtros['fornecedorId']);
        }

        return $query->get();
    }

    public function map($itemFornecedor): array{
        return [
            $itemFornecedor->id,
            $itemFornecedor->item->nome,
            $itemFornecedor->item->descricao ?? 'N/A',
            $itemFornecedor->fornecedor->nome,
            $itemFornecedor->fornecedor->cnpj.' ',
            $itemFornecedor->fornecedor->cliente_segmetre ? 'Sim' : 'Não',
            'R$'.$itemFornecedor->valor_unitario ?? 'N/A',
        ];
    }

    public function headings(): array{
        return [
            'ID',
            'Item',
            'Descrição',
            'Fornecedor',
            'CNPJ',
            'Cliente Segmetre?',
            'Valor Unitário'
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
        ];
    }

    public function title(): string
    {
        return 'Relatório de Estoque';
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
