<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'surat_masuk_id',
        'tipe_media',
        'slug',
        'judul',
        'isi',
        'foto',
        'link_youtube',
        'audio',
        'naskah',
        'keterangan',
        'status',
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });

        static::updating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });
    }
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'berita_id');
    }

    // public function reporters()
    // {
    //     return $this->hasMany(Reporters::class, 'berita_id');
    // }

    // Relasi ke model User
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function reporters()
    {
        return $this->belongsToMany(Reporters::class, 'berita_reporter', 'berita_id', 'reporter_id')
            ->withTimestamps();
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}
