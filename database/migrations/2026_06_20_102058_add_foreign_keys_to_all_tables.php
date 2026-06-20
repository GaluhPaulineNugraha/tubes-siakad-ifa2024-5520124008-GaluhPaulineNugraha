<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Foreign key mahasiswa -> dosen
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign('nidn')
                  ->references('nidn')
                  ->on('dosen')
                  ->onDelete('cascade');
        });

        // 2. Foreign key jadwal -> matakuliah & dosen
        Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('kode_matakuliah')
                  ->references('kode_matakuliah')
                  ->on('matakuliah')
                  ->onDelete('cascade');
                  
            $table->foreign('nidn')
                  ->references('nidn')
                  ->on('dosen')
                  ->onDelete('cascade');
        });

        // 3. Foreign key krs -> mahasiswa & matakuliah
        Schema::table('krs', function (Blueprint $table) {
            $table->foreign('npm')
                  ->references('npm')
                  ->on('mahasiswa')
                  ->onDelete('cascade');
                  
            $table->foreign('kode_matakuliah')
                  ->references('kode_matakuliah')
                  ->on('matakuliah')
                  ->onDelete('cascade');
        });

        // 4. Foreign key users -> mahasiswa & dosen
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('mahasiswa_id')
                  ->references('npm')
                  ->on('mahasiswa')
                  ->onDelete('set null');
                  
            $table->foreign('nidn')
                  ->references('nidn')
                  ->on('dosen')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropForeign(['nidn']);
        });

        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign(['npm']);
            $table->dropForeign(['kode_matakuliah']);
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['kode_matakuliah']);
            $table->dropForeign(['nidn']);
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['nidn']);
        });
    }
};