<?php

namespace Database\Seeders;

use App\Models\Reporters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReporterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reporters::create([
            'surat_masuk_id' => 1,  // Pastikan ID ini ada di tabel surat_masuk
            'user_id' => 4,         // Pastikan ID ini ada di tabel users
            'tipe' => 'media',
        ]);
    }
}
