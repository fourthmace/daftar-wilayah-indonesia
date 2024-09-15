<?php

namespace App\Services\Impl;

use Illuminate\Http\Request;
use App\Models\WilayahModified;
use Illuminate\Http\JsonResponse;
use App\Excel\ExcelWilayahModified;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Exceptions\GeneralException;
use App\Services\WilayahModifiedService;

class WilayahModifiedServiceImpl implements WilayahModifiedService
{
    public function wilayahModifiedDataTable(Request $request): JsonResponse
    {
        try {
            $no   = $request->start+1;
            $rows = WilayahModified::query();

            // Filter
            if ($request->kode_provinsi) {
                $rows->where('kode_provinsi', $request->kode_provinsi);
            }
            if ($request->kode_kabupaten_kota) {
                $rows->where('kode_kabupaten_kota', $request->kode_kabupaten_kota);
            }
            if ($request->kode_kecamatan) {
                $rows->where('kode_kecamatan', $request->kode_kecamatan);
            }
            if ($request->kode_kelurahan_desa) {
                $rows->where('kode_kelurahan_desa', $request->kode_kelurahan_desa);
            }
            if (!empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $rows->where(function ($query) use ($searchValue) {
                    $query->where('kode', 'LIKE', "%$searchValue%")
                        ->orWhere('kode_provinsi', 'LIKE', "%$searchValue%")
                        ->orWhere('kode_kabupaten_kota', 'LIKE', "%$searchValue%")
                        ->orWhere('kode_kecamatan', 'LIKE', "%$searchValue%")
                        ->orWhere('kode_kelurahan_desa', 'LIKE', "%$searchValue%")
                        ->orWhere('nama', 'LIKE', "%$searchValue%");
                });
            }

            // Sorting
            $orderColumnIndex = $request->order[0]['column'] ?? 0;
            $orderDirection   = $request->order[0]['dir'] ?? 'asc';
            $columns = [
                0 => 'kode',
                1 => 'type',
                2 => 'kode_provinsi',
                3 => 'kode_kabupaten_kota',
                4 => 'kode_kecamatan',
                5 => 'kode_kelurahan_desa',
                6 => 'nama'
            ];

            $orderColumn = $columns[$orderColumnIndex] ?? 'id';
            $rows->orderBy($orderColumn, $orderDirection);

            // Pagination
            $length = (int) $request->length;
            $start  = (int) $request->start;
            $page   = ($start / $length) + 1;

            $paginatedRows = $rows->select('kode', 'kode_provinsi', 'kode_kabupaten_kota', 'kode_kecamatan', 'kode_kelurahan_desa', 'type', 'nama')
                ->orderBy($orderColumn, $orderDirection)
                ->paginate($length, ['*'], 'page', $page);

                // Add 'no' column
            $paginatedMaps = $paginatedRows->items();
            $paginatedMaps = array_map(function ($item) use (&$no) {
                $item->no = $no++;
                return $item;
            }, $paginatedMaps);

            return response()->json([
                'draw'              => (int) $request->draw,
                'recordsTotal'      => $paginatedRows->total(),
                'recordsFiltered'   => $paginatedRows->total(),
                'data'              => $paginatedMaps
            ]);
        } catch (\Throwable $th) {
            throw new GeneralException($th->getMessage(), 500);
        }
    }

    public function wilayahModifiedDownloadJson(Request $request): JsonResponse
    {
        try {
            $fileName = str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) . ".json";
            $filePath = database_path('data/' . $fileName);

            // Membaca isi file JSON
            if (!File::exists($filePath)) {
                return response()->json(
                    [
                        'message' => 'File JSON tidak ditemukan.',
                        'data'    => []
                    ],
                    404
                );
            } else {
                File::copy($filePath, env('TMP_FOLDER') . "/" .$fileName);

                return response()->json(
                    [
                        'message' => 'json berhasil dibuat',
                        'data'    => [
                            'url' => env("APP_URL") . '/api/download_file' . "?file_name=" . $fileName
                        ]
                    ],
                    200
                );
            }
        } catch (\Throwable $th) {
            throw new GeneralException($th->getMessage(), 500);
        }
    }

    public function wilayahModifiedDownloadExcel(Request $request): JsonResponse
    {
        try {
            $fileName = str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) . ".xlsx";
            $filePath = database_path('data/' . $fileName);

            // Membaca isi file XLSX
            if (!File::exists($filePath)) {
                return response()->json(
                    [
                        'message' => 'File XLSX tidak ditemukan.',
                        'data'    => []
                    ],
                    404
                );
            } else {
                File::copy($filePath, env('TMP_FOLDER') . "/" .$fileName);

                return response()->json(
                    [
                        'message' => 'excel berhasil dibuat',
                        'data'    => [
                            'url' => env("APP_URL") . '/api/download_file' . "?file_name=" . $fileName
                        ]
                    ],
                    200
                );
            }
        } catch (\Throwable $th) {
            throw new GeneralException($th->getMessage(), 500);
        }
    }

    public function wilayahModifiedDownloadExcel_failed(Request $request): JsonResponse
    {
        try {
            // Get Rows
            // $rows = WilayahModified::select('kode', 'kode_provinsi', 'kode_kabupaten_kota', 'kode_kecamatan', 'kode_kelurahan_desa', 'type', 'nama')
            //     ->orderBy('id', 'ASC')
            //     ->get();

            // Get Rows From Json
            $filePath = database_path('data/' . str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) . ".json");

            // Membaca isi file JSON
            if (!File::exists($filePath)) {
                return response()->json(
                    [
                        'message' => 'File JSON tidak ditemukan.',
                        'data'    => []
                    ],
                    404
                );
            } else {
                $jsonData = File::get($filePath);
                $rows     = json_decode($jsonData); // Mengubah JSON menjadi array objek

                // Modify Rows
                $no = 1;
                $newRows = [];
                foreach ($rows as $row) {
                    $newRow = [
                        'no'                    => $no++,
                        'kode'                  => $row->kode,
                        'kode_provinsi'         => $row->kode_provinsi,
                        'kode_kabupaten_kota'   => $row->kode_kabupaten_kota,
                        'kode_kecamatan'        => $row->kode_kecamatan,
                        'kode_kelurahan_desa'   => $row->kode_kelurahan_desa,
                        'type'                  => $row->type,
                        'nama'                  => $row->nama,
                    ];
                    $newRows[] = $newRow;
                }

                $data = [
                    'sheet1' => $newRows
                ];

                $file_name = str_replace(" ", "_", env('WILAYAN_VERSION_NAME')) ."_". date("YmdHis", time()) .'.xlsx';
                Excel::store(new ExcelWilayahModified($data), $file_name, 'excel'); // see config/filesystems.php

                return response()->json(
                    [
                        'message' => 'excel berhasil dibuat',
                        'data'    => [
                            'url' => env("APP_URL") . '/api/download_file' . "?file_name=" . $file_name
                        ]
                    ],
                    200
                );
            }
        } catch (\Throwable $th) {
            throw new GeneralException($th->getMessage(), 500);
        }
    }

}
