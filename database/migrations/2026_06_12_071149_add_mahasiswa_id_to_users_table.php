<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'mahasiswa_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->char('mahasiswa_id', 10)->nullable()->after('email');
                $table->foreign('mahasiswa_id')->references('npm')->on('mahasiswa')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'mahasiswa_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['mahasiswa_id']);
                $table->dropColumn('mahasiswa_id');
            });
        }
    }
};