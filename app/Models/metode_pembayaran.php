<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metode_pembayaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function metode()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
