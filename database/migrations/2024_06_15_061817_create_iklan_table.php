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
        Schema::create('iklan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_masuk_id');
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->string('lokasi', 255);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['ditolak', 'diterima'])->default('diterima');
            $table->string('no_pengaju', 15);
            $table->string('nama_pengaju', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iklan');
    }
};
