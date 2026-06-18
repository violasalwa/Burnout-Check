<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('percobaan_tes', function (Blueprint $table) {
            $table->id();

            // 🔥 jika user dihapus → data ikut hilang
            $table->foreignId('pengguna_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->integer('total_skor');

            // 🔥 INI YANG WAJIB FIX
            $table->foreignId('level_risiko_id')
                ->nullable()
                ->constrained('level_risiko')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('percobaan_tes');
    }
};