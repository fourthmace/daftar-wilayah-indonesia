<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path ke file SQL
        $sqlFilePath = database_path('data/' . env('WILAYAN_VERSION_FILE'));

        // Cek apakah file ada
        if (File::exists($sqlFilePath)) {
            // Baca isi file SQL
            $sql = File::get($sqlFilePath);

            // Jalankan SQL
            DB::unprepared($sql);

            $this->command->info('Wilayah data seeded successfully from kepmendagri_no_100.1.1-6117_tahun_2022');
        } else {
            $this->command->error('SQL file not found at: ' . $sqlFilePath);
        }
    }
}
