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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['iklan', 'peliputan']);
            $table->string('tipe_iklan')->nullable();
            $table->string('periode')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->decimal('ppn', 5, 2)->nullable();
            $table->string('nama_acara')->nullable();
            $table->string('lokasi_acara')->nullable();
            $table->string('waktu_acara')->nullable();
            $table->date('tanggal_acara')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak']);
            $table->foreignId('kepala_bidang_id')->constrained('users');
            $table->string('ttd_qrcode')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
