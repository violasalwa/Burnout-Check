<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {

            // hapus foreign lama
            $table->dropForeign(['soal_id']);

            // buat ulang dengan cascade
            $table->foreign('soal_id')
                ->references('id')
                ->on('soal')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {

            $table->dropForeign(['soal_id']);

            $table->foreign('soal_id')
                ->references('id')
                ->on('soal');
        });
    }
};