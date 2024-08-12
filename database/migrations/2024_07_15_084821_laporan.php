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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('nama_pengirim');
            $table->string('instansi');
            $table->string('bidang');
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable(); // ID kepala bidang yang menyetujui
            $table->timestamp('approved_at')->nullable(); // Waktu approval
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
        Schema::dropIfExists('laporan');
    }
};
