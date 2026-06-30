<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbProduk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';

    protected $primaryKey = 'ID_PRODUK';

    protected $fillable = [
        'ID_TOKO',
        'NAMA_PRODUK',
        'HARGA',
        'KATEGORI',
        'STOK',
        'STATUS',
        'FOTO_PRODUK',
        'DESK',
        'RATING'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}