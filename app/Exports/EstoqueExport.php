<?php

namespace App\Exports;

use App\Models\ItemSetor;

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


class EstoqueExport implements FromCollection, 
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
        $query = ItemSetor::query();

        if(!empty($this->filtros['setor'])){
            $query->where('setor_id', $this->filtros['setor']);
        }

        if(!empty($this->filtros['tolerancia'])){
            $query->where('qtd_estoque', '<', $this->filtros['tolerancia']);
        }

        if(!empty($this->filtros['nomeItem'])){
            $busca = $this->filtros['nomeItem'];

            $query->whereHas('item', function ($q) use ($busca) {
                $q->where('nome', 'LIKE', "%{$busca}%");
            });
        }

        return $query->get();
    }

    public function map($itemSetor): array{
        return [
            $itemSetor->id,
            $itemSetor->setor->nome,
            $itemSetor->item->nome,
            $itemSetor->item->descricao ?? 'N/A',
            $itemSetor->qtd_estoque,
            $itemSetor->created_at,
        ];
    }

    public function headings(): array{
        return [
            'ID',
            'Setor',
            'Item',
            'Descrição',
            'Qtd em Estoque',
            'Lançado em'
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
