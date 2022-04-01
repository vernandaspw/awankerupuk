<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cartdetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }
}
