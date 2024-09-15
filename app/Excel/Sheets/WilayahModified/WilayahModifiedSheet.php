<?php

namespace App\Excel\Sheets\WilayahModified;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WilayahModifiedSheet implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting, WithMapping, WithStrictNullComparison, WithEvents
{
    protected $rows;
    protected $newTitle;

    public function __construct(array $rows, string $title)
    {
        $this->rows     = $rows;
        $this->newTitle = $title;
    }

    public function map($row): array
    {
        return [
            $row['no'],
            $row['kode'],
            $row['kode_provinsi'],
            $row['kode_kabupaten_kota'],
            $row['kode_kecamatan'],
            $row['kode_kelurahan_desa'],
            $row['type'],
            $row['nama'],
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NO',
                'KODE',
                'KODE PROVINSI',
                'KODE KABUPATEN/KOTA',
                'KODE KECAMATAN',
                'KODE KELURAHAN/DESA',
                'TIPE',
                'NAMA',
            ],
        ];
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function title(): string
    {
        return $this->newTitle;
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,  // Kolom KODE
            'C' => NumberFormat::FORMAT_TEXT,  // Kolom KODE PROVINSI
            'D' => NumberFormat::FORMAT_TEXT,  // Kolom KODE KABUPATEN/KOTA
            'E' => NumberFormat::FORMAT_TEXT,  // Kolom KODE KECAMATAN
            'F' => NumberFormat::FORMAT_TEXT,  // Kolom KODE KELURAHAN/DESA
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                /* Set the height of row  */
                $sheet->getRowDimension(1)->setRowHeight(20);

                // Apply background color and border to header
                $sheet->getStyle('A1:H1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'D3D3D3'] // Light grey background
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                 $sheet->getStyle('C:F')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
            },
        ];
    }
}
