<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(bahan_kategori::class, 'bahan_kategori_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(bahan_brands::class, 'bahan_brand_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class, 'satuan_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(BahanRate::class, 'bahans_id', 'id');
    }
}
