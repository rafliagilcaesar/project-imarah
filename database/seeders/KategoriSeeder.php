<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Kategori::insert([
           ['nama_kategori' => 'Digital Printing'],
           ['nama_kategori' => 'Spanduk'],
           ['nama_kategori' => 'Poster'],
       ]);

    }
}
