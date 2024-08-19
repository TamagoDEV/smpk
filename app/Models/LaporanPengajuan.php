<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengajuan extends Model
{
    use HasFactory;

    protected $table = 'laporan_pengajuan'; // Sesuaikan nama tabel jika diperlukan

    // Jika Anda memiliki kolom yang bisa diisi (fillable), Anda bisa mendefinisikannya di sini:
    protected $fillable = ['nama_pengajuan', 'keterangan', 'tanggal_pengajuan', 'approved', 'approved_by', 'approved_at'];

    // Relasi dengan tabel laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'laporan_pengajuan_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
