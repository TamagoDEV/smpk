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
        Schema::create('website_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_avropal');
            $table->string('judul', 255);
            $table->text('isi');
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['ditolak', 'diterima'])->default('diterima');
            $table->string('slug', 255)->unique();
            $table->text('catatan')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_media');
    }
};
