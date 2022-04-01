<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanBahanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pesanbahan()
    {
        return $this->belongsTo(PesanBahan::class, 'pesan_bahan_id', 'id');
    }
}
