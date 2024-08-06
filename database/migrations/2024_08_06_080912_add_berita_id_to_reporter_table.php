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
        Schema::table('reporter', function (Blueprint $table) {
            $table->foreignId('berita_id')->nullable()->constrained('berita')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reporter', function (Blueprint $table) {
            $table->dropForeign(['berita_id']);
            $table->dropColumn('berita_id');
        });
    }
};
