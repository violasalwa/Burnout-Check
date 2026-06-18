<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // CEK dulu biar tidak error kalau sudah ada
            if (!Schema::hasColumn('users', 'dosen_id')) {
                $table->foreignId('dosen_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'dosen_id')) {
                $table->dropForeign(['dosen_id']);
                $table->dropColumn('dosen_id');
            }

        });
    }
};