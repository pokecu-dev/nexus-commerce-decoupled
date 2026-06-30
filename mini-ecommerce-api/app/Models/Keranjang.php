<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'ID_KERANJANG';

    protected $fillable = [
        'ID_USER', 'ID_PRODUK', 'QTY'
    ];

    protected $with = ['produk']; 
    protected $hidden = ['created_at', 'updated_at']; 

    public function produk()
    {
        return $this->belongsTo(TbProduk::class, 'ID_PRODUK', 'ID_PRODUK');
    }
}
