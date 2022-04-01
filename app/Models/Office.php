<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Office extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'office';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nohp',
        'password',
        'role',
        'isAktif'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dibuatlogstokproduks()
    {
        return $this->hasMany(LogStokProduk::class, 'dibuat_office_id', 'id');
    }

    public function diubahlogstokproduks()
    {
        return $this->hasMany(LogStokProduk::class, 'diubah_office_id', 'id');
    }
}
