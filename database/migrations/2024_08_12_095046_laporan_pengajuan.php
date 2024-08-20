<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengajuan'); // Nama pengajuan atau deskripsi
            $table->text('keterangan')->nullable(); // Keterangan tambahan jika ada
            $table->timestamp('tanggal_pengajuan')->nullable(); // Tanggal pengajuan
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable(); // ID kepala bidang yang menyetujui
            $table->timestamp('approved_at')->nullable(); // Waktu approval
            $table->string('bulan'); // Nama pengajuan atau deskripsi
            $table->string('tahun'); // Nama pengajuan atau deskripsi
            $table->timestamps(); // ini akan menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key ke tabel users jika relasi dengan pengguna diperlukan
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pengajuan');
    }
};
