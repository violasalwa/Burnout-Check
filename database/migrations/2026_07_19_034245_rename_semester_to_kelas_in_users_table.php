<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'semester') || Schema::hasColumn('users', 'kelas')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->integer('kelas')->nullable()->after('role');
        });

        DB::statement('UPDATE users SET kelas = semester');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('users', 'kelas') || Schema::hasColumn('users', 'semester')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->integer('semester')->nullable()->after('role');
        });

        DB::statement('UPDATE users SET semester = kelas');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }
};
