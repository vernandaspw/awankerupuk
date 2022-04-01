<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cartsupps()
    {
        return $this->hasMany(cart_bahan_supp::class, 'cart_bahan_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
