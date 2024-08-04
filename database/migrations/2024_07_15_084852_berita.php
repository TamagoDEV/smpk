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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_media', ['website', 'radio', 'youtube', 'media_lain']);
            $table->foreignId('surat_id')->constrained('surat_masuk');
            $table->string('slug')->unique();
            $table->string('judul');
            $table->text('isi');
            $table->string('foto')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('audio')->nullable();
            $table->string('naskah')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
