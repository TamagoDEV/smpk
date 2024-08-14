<?php

namespace Database\Seeders;

use App\Models\BeritaReporter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaReporterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BeritaReporter::create([
            'berita_id' => 1,
            'reporter_id' => 1,
        ]);
    }
}
