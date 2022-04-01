<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplier_id', 'id');
    }

    public function setting()
    {
        return $this->belongsTo(setting::class, 'setting_id', 'id');
    }
    public function bahan()
    {
        return $this->belongsTo(bahan::class, 'bahan_id', 'id');
    }
}
