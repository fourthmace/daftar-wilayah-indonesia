### Data Wilayah

Informasi terdiri dari

-   [x] Tipe wilayah
-   [x] Kode provinsi, kabupaten/kota, kecamatam, kelurahan/desa
-   [x] Nama wilayah
-   [x] XLSX
-   [x] JSON

### Cara Update Data Wilayah

1. buka github https://github.com/cahyadsn/wilayah (hahaha)

2. download file wilayah.sql

3. letakan di folder database/data

4. renama nama file wilayah.sql menjadi nomor peraturan yang dikeluarkan oleh **kepmendagri**
   contoh: `kepmendagri_no_100.1.1-6117_tahun_2022.sql`

5. modifikasi file .env pada bagian berikut

    ```bash
    WILAYAN_VERSION_NAME='kepmendagri no 100.1.1-6117 tahun 2022'
    WILAYAN_VERSION_FILE='kepmendagri_no_100.1.1-6117_tahun_2022.sql'
    ```

6. refresh migration

    ```bash
    $ php artisan migrate:rollback
    $ php artisan migrate
    ```

7. insert ulang data dengan laravel seeder

    ```bash
    $ php artisan db:seed
    ```
