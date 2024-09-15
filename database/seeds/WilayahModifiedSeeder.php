<?php

use App\Models\Wilayah;
use App\Models\WilayahModified;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Excel\ExcelWilayahModified;
use Maatwebsite\Excel\Facades\Excel;

class WilayahModifiedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter      = 1;
        $dataForJson  = [];
        $dataForXlsx  = [];
        $wilayahRaw   = Wilayah::get();
        $wilayahTipe  = ['provinsi','kabupaten-kota','kecamatan','kelurahan-desa'];

        foreach ($wilayahRaw as $row) {
            $kode_split = explode(".", $row->kode);
            $data       = [
                "no"                    => $counter,
                "kode"                  => $row->kode,
                "kode_provinsi"         => $kode_split[0],
                "kode_kabupaten_kota"   => isset($kode_split[1]) ? $kode_split[1] : null,
                "kode_kecamatan"        => isset($kode_split[2]) ? $kode_split[2] : null,
                "kode_kelurahan_desa"   => isset($kode_split[3]) ? $kode_split[3] : null,
                "type"                  => isset($wilayahTipe[count($kode_split)-1]) ? $wilayahTipe[count($kode_split)-1] : null,
                "nama"                  => $row->nama,
            ];

            $dataForXlsx[] = $data;
            unset($data['no']);
            $dataForJson[] = $data;

            $counter++;
            $this->command->info($row);
            WilayahModified::firstOrCreate($data);
        }

        $this->saveToJsonFile($dataForJson);
        $this->saveToExcelFile($dataForXlsx);
        $this->command->info($counter . " Wilayah Modified seeded successfully");
    }

    private function saveToJsonFile(array $data)
    {
        $filePath = database_path('data/' . str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) . ".json");

        if (!File::exists(database_path('data'))) {
            File::makeDirectory(database_path('data'), 0755, true);
        }

        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function saveToExcelFile(array $data)
    {
        $dataSheet = [
            'sheet1' => $data
        ];
        Excel::store(new ExcelWilayahModified($dataSheet), str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) . ".xlsx", 'excel_database');
    }
}
