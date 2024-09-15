<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WilayahModifiedService;

class WilayahModifiedController extends Controller
{
    protected $wService;

    public function __construct(WilayahModifiedService $wService)
    {
        $this->wService = $wService;
    }

    /**
     * View - Halaman Utama
     * ---------------------------
     */
    public function wilayahModifiedPageMain(Request $request)
    {
        $data = [
            'metaTitle' => 'List Wilayah',
        ];

        return view('pages/wilayah_modified', $data);
    }

    /**
     * API - Data table - Wilayah Modified
     * ---------------------------
     */
    public function wilayahModifiedDataTable(Request $request)
    {
        try {
            return $this->wService->wilayahModifiedDataTable($request);
        }
        catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                    'data'    => [],
                ],
                is_int($th->getCode()) ? $th->getCode() : 500
            );
        }
    }

    /**
     * API - Download Json - Wilayah Modified
     * ---------------------------
     */
    public function wilayahModifiedDownloadJson(Request $request)
    {
        try {
            return $this->wService->wilayahModifiedDownloadJson($request);
        }
        catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                    'data'    => [],
                ],
                is_int($th->getCode()) ? $th->getCode() : 500
            );
        }
    }

    /**
     * API - Download Excel - Wilayah Modified
     * ---------------------------
     */
    public function wilayahModifiedDownloadExcel(Request $request)
    {
        try {
            return $this->wService->wilayahModifiedDownloadExcel($request);
        }
        catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                    'data'    => [],
                ],
                is_int($th->getCode()) ? $th->getCode() : 500
            );
        }
    }
}
