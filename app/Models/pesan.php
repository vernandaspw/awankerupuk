<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
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

    public function pesan_details()
    {
        return $this->hasMany(pesan_detail::class, 'pesan_id', 'id');
    }
}
