<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah foreign key ke mahasiswa
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('mahasiswa_id')
                  ->references('npm')
                  ->on('mahasiswa')
                  ->onDelete('set null');
        });
        
        // Tambah foreign key ke dosen
        Schema::table('users', function (Blueprint $table) {
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
    }
};