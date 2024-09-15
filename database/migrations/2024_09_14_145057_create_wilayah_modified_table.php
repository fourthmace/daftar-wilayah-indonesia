<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahModifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_modified', function (Blueprint $table) {
            $table->id();
            $table->string("kode", 20)->nullable(false);
            $table->string("kode_provinsi", 10)->nullable(true);
            $table->string("kode_kabupaten_kota", 10)->nullable(true);
            $table->string("kode_kecamatan", 10)->nullable(true);
            $table->string("kode_kelurahan_desa", 20)->nullable(true);
            $table->text("nama", 150)->nullable(true);
            $table->enum("type", ['provinsi','kabupaten-kota','kecamatan','kelurahan-desa'])->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah_modified');
    }
};
