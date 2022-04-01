<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_bahan_supp extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cartdetails()
    {
        return $this->hasMany(cart_bahan_detail::class, 'cart_bahan_supp_id', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(cart_bahan::class, 'cart_bahan_id', 'id');
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
