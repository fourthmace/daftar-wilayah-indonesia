<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table      = "wilayah";
    protected $primaryKey = "kode";
    protected $keyType    = 'string';
    protected $fillable   = [
        "kode",
        "nama",
    ];
}
