<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bahan()
    {
        return $this->belongsTo(bahan::class, 'bahans_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }
}
