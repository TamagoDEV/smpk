<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // Sesuaikan nama tabel jika diperlukan

    // Jika Anda memiliki kolom yang bisa diisi (fillable), Anda bisa mendefinisikannya di sini:
    protected $fillable = ['laporan_pengajuan_id', 'berita_id', 'surat_masuk_id', 'reporter_id',];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    // Relasi dengan surat masuk
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    // Relasi dengan reporter
    public function reporter()
    {
        return $this->belongsTo(Reporters::class, 'reporter_id');
    }
}
