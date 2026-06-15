<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->char('npm', 10)->primary();
            $table->char('nidn', 10);
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('no_telepon', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
            
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};