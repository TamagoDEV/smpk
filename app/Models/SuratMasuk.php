<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'jenis',
        'nama_pengirim',
        'instansi',
        'bidang',
        'no_hp',
        'kontak_lain',
        'tipe_iklan',
        'periode',
        'harga',
        'ppn',
        'nama_acara',
        'lokasi_acara',
        'waktu_acara',
        'tanggal_acara',
        'status',
        'kepala_bidang_id',
        'ttd_qrcode',
        'approved_at',
    ];

    // Relasi ke model User
    public function kepalaBidang()
    {
        return $this->belongsTo(User::class, 'kepala_bidang_id');
    }
    public function reporters()
    {
        return $this->hasMany(Reporters::class, 'surat_masuk_id');
    }
}
