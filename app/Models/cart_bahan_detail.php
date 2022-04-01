<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_bahan_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bahan()
    {
        return $this->belongsTo(bahan::class, 'bahan_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function cartsupps()
    {
        return $this->belongsTo(cart_bahan_supp::class, 'cart_bahan_supp_id', 'id');
    }
}
