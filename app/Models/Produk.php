<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'produk_kategori_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(ProdukBrand::class, 'produk_brand_id', 'id');
    }

    public function stoks()
    {
        return $this->hasMany(ProdukStok::class, 'produk_id', 'id');
    }

    public function cartdetail()
    {
        return $this->hasOne(CartDetail::class, 'produk_id', 'id');
    }

    public function detailtransaksis()
    {
        return $this->hasMany(TransaksiDetail::class, 'produk_id', 'id');
    }
}
