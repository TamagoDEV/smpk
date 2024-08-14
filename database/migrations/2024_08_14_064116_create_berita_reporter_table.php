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
        Schema::create('berita_reporter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('reporter')->onDelete('cascade');
            $table->foreignId('berita_id')->constrained('berita')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_reporter');
    }
};
