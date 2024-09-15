<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahModifiedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/wilayah-modified', [WilayahModifiedController::class, 'wilayahModifiedDataTable']);
Route::get('/wilayah-modified-json', [WilayahModifiedController::class, 'wilayahModifiedDownloadJson']);
Route::get('/wilayah-modified-excel', [WilayahModifiedController::class, 'wilayahModifiedDownloadExcel']);

Route::get('/download_file', function (Request $request) {
    $file_name      = $request->query('file_name');
    $full_file_name = env("TMP_FOLDER") . "/" . $file_name;

    if (file_exists($full_file_name)) {
        return response()->download($full_file_name)->deleteFileAfterSend(true);
    }
});
