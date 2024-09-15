<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Excel\Sheets\WilayahModified\WilayahModifiedSheet;

class ExcelWilayahModified implements FromArray, WithMultipleSheets
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function sheets(): array
    {
        $sheets = [
            new WilayahModifiedSheet($this->data['sheet1'],'wilayah modified'),
        ];

        return $sheets;
    }

}
