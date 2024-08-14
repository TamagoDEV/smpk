<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporters extends Model
{
    use HasFactory;

    protected $table = 'reporter';

    protected $fillable = [
        'surat_masuk_id',
        'user_id',
        'berita_id',
        'tipe',
    ];

    // Define the relationship with the SuratMasuk model
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function berita()
    {
        return $this->belongsToMany(Berita::class, 'berita_reporter', 'reporter_id', 'berita_id')
            ->withTimestamps();
    }
}
