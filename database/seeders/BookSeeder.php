<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('
            INSERT INTO books (kategori, judul, penulis, penerbit, tahun, jumlah)
            SELECT kategori, judul, nama, penerbit, tahun, jumlah
            FROM databuku
        ');
    }
}
