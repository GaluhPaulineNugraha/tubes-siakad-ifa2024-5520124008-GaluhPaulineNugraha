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

        // 2. DOSEN 
        $dosenList = Dosen::all();
        foreach ($dosenList as $dosen) {
            // Buat email dari nama
            $emailBase = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $dosen->nama));
            $email = $emailBase . '@gmail.com';
            
            $counter = 1;
            $originalEmail = $email;
            while (User::where('email', $email)->exists()) {
                $email = str_replace('@gmail.com', $counter . '@gmail.com', $originalEmail);
                $counter++;
            }
            
            User::updateOrCreate(
                ['nidn' => $dosen->nidn],
                [
                    'name' => $dosen->nama,
                    'email' => $email,
                    'password' => Hash::make('dosen12345'),
                    'nidn' => $dosen->nidn,
                ]
            );
        }

        // 3. MAHASISWA 
        $mahasiswaList = Mahasiswa::all();
        foreach ($mahasiswaList as $mhs) {
            $emailBase = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $mhs->nama));
            $email = $emailBase . '@gmail.com';
            
            $counter = 1;
            $originalEmail = $email;
            while (User::where('email', $email)->exists()) {
                $email = str_replace('@gmail.com', $counter . '@gmail.com', $originalEmail);
                $counter++;
            }
            
            User::updateOrCreate(
                ['mahasiswa_id' => $mhs->npm],
                [
                    'name' => $mhs->nama,
                    'email' => $email,
                    'password' => Hash::make('mahasiswa12345'),
                    'mahasiswa_id' => $mhs->npm,
                ]
            );
        }
    }
}