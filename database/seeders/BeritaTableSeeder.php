<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Berita::create([
            'tipe_media' => 'website',
            'surat_masuk_id' => 1,  // Pastikan ID ini ada di tabel surat_masuk
            'slug' => 'peluncuran-produk',
            'judul' => 'Peluncuran Produk Baru PT. ABC',
            'isi' => 'PT. ABC meluncurkan produk baru pada tanggal 15 Juli 2024 di Jakarta...',
            'foto' => 'path/to/foto.jpg',
            'link_youtube' => 'https://youtube.com/video',
            'audio' => 'path/to/audio.mp3',
            'naskah' => 'path/to/naskah.docx',
            'keterangan' => 'Peluncuran produk ini dihadiri oleh banyak tokoh penting...',
        ]);
    }
}
