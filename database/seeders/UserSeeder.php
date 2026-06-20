<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );

        // 2. DOSEN - PASTIKAN INI BERJALAN
        $dosenList = Dosen::all();
        foreach ($dosenList as $dosen) {
            $email = strtolower(str_replace([' ', '.', ',', "'"], '', $dosen->nama)) . '@gmail.com';
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $dosen->nama,
                    'password' => Hash::make('dosen12345'),
                    'nidn' => $dosen->nidn,
                ]
            );
        }

        // 3. MAHASISWA
        $mahasiswaList = Mahasiswa::all();
        foreach ($mahasiswaList as $mhs) {
            $email = strtolower(str_replace([' ', '.', ',', "'"], '', $mhs->nama)) . '@gmail.com';
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $mhs->nama,
                    'password' => Hash::make('mahasiswa12345'),
                    'mahasiswa_id' => $mhs->npm,
                ]
            );
        }
    }
}