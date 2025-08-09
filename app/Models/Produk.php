<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Ensure the table name matches the migration
    protected $fillable = [
        'nama_produk',
        'slug',
        'harga',
        'kategori',
        'deskripsi',
        'gambar',
    ];

   public function kategoriNama()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id');
    }
}
