<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahModified extends Model
{
    protected $table      = "wilayah_modified";
    protected $primaryKey = "id";
    protected $fillable   = [
        "kode",
        "kode_provinsi",
        "kode_kabupaten_kota",
        "kode_kecamatan",
        "kode_kelurahan_desa",
        "type",
        "nama",
    ];
}
