<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface WilayahModifiedService
{
    public function wilayahModifiedDataTable(Request $request): JsonResponse;

    public function wilayahModifiedDownloadJson(Request $request): JsonResponse;

    public function wilayahModifiedDownloadExcel(Request $request): JsonResponse;
}
