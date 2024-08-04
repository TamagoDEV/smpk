<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'tipe_media',
        'surat_id',
        'slug',
        'judul',
        'isi',
        'foto',
        'link_youtube',
        'audio',
        'naskah',
        'keterangan',
    ];

    /**
     * Relasi ke model SuratMasuk.
     */
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_id');
    }
}
