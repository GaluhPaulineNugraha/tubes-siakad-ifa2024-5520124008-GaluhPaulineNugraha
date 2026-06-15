<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->char('kode_matakuliah', 8);
            $table->char('nidn', 10);
            $table->enum('kelas', ['A', 'B', 'C', 'D', 'E']);
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan', 50)->nullable();
            $table->string('tahun_akademik', 20)->default('2024/2025');
            $table->timestamps();
            
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')->onDelete('cascade');
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');
            
            $table->unique(['kode_matakuliah', 'kelas', 'hari', 'jam_mulai'], 'unique_jadwal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};