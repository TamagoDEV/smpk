<?php

namespace Database\Seeders;

use App\Models\SuratMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratMasukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratMasuk::create([
            'jenis' => 'Iklan',
            'nama_pengirim' => 'PT. ABC',
            'instansi' => 'Perusahaan ABC',
            'bidang' => 'Pemasaran',
            'no_hp' => '081234567890',
            'kontak_lain' => '02123456789',
            'dokumen_surat' => 'path/to/dokumen.pdf',
            'tipe_iklan' => 'Produk',
            'periode' => '2024-07-01 to 2024-07-30',
            'harga' => 1000000.00,
            'ppn' => 110000.00,
            'nama_acara' => 'Peluncuran Produk',
            'lokasi_acara' => 'Jakarta',
            'waktu_acara' => '10:00',
            'tanggal_acara' => '2024-07-15',
        ]);
    }
}
