<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('percobaan_tes', function (Blueprint $table) {

            $table->dropForeign(['pengguna_id']);

            $table->foreign('pengguna_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->dropForeign(['level_risiko_id']);

            $table->foreign('level_risiko_id')
                ->references('id')
                ->on('level_risiko')
                ->nullOnDelete(); // lebih aman
        });
    }

    public function down(): void
    {
        Schema::table('percobaan_tes', function (Blueprint $table) {

            $table->dropForeign(['pengguna_id']);
            $table->dropForeign(['level_risiko_id']);

            $table->foreign('pengguna_id')->references('id')->on('users');
            $table->foreign('level_risiko_id')->references('id')->on('level_risiko');
        });
    }
};