<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kantor extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = [
        'nama',
        'jabatan',
        'telpon',
        'alamat',

    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
