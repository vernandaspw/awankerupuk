<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukBrand extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'produk_brand_id', 'id');
    }
}
