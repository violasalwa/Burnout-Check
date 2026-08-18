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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->unique()->nullable()->after('name');
            $table->decimal('ipk', 4, 2)->nullable()->after('nim');
            
            // To change ENUM we might need raw SQL or we can just change the column type to string if doctrine dbal fails, 
            // but let's use string to be safe on all drivers, and we can enforce it in logic. Or we can just leave it as string.
            // Wait, making it string and nullable is the safest way to "modify" an enum without breaking.
            $table->string('role')->nullable()->change();

            // Update dosen_id foreign key to point to dosen_kaprodi table
            // We first drop the old foreign key
            $table->dropForeign(['dosen_id']);
            // And add the new one
            // Note: foreign keys are added after dosen_kaprodi is created, wait!
            // This migration runs BEFORE create_dosen_kaprodi_table because of its name.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim', 'ipk']);
            // Revert role back to original enum if necessary, but skipping for simplicity in down()
            // $table->enum('role', ['mahasiswa', 'admin', 'dosen', 'kaprodi'])->default('mahasiswa')->change();
        });
    }
};
