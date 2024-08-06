<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuratMasukIdToBeritaTable extends Migration
{
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_masuk_id')->nullable()->after('id');

            // Jika ingin membuat relasi foreign key
            $table->foreign('surat_masuk_id')->references('id')->on('surat_masuk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropForeign(['surat_masuk_id']);
            $table->dropColumn('surat_masuk_id');
        });
    }
}
