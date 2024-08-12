<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // Sesuaikan nama tabel jika diperlukan

    // Jika Anda memiliki kolom yang bisa diisi (fillable), Anda bisa mendefinisikannya di sini:
    protected $fillable = ['jenis', 'nama_pengirim', 'instansi', 'bidang', 'approved', 'created_at'];
}
