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
            $emailDosen = match($dosen->nidn) {
                '1234567801' => 'ahmadrizki@gmail.com',
                '1234567802' => 'profsitinurhaliza@gmail.com',
                '1234567803' => 'drbudisantoso@gmail.com',
                '1234567804' => 'dewilestari@gmail.com',
                '1234567805' => 'drekoprasetyo@gmail.com',
                default => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $dosen->nama)) . '@gmail.com',
            };
            
            User::updateOrCreate(
                ['email' => $emailDosen],
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
            $emailMhs = match($mhs->npm) {
                '2024000001' => 'galuhpaulinenugraha@gmail.com',
                '2024000002' => 'andisaputra@gmail.com',
                '2024000003' => 'budiwijaya@gmail.com',
                '2024000004' => 'citraamalia@gmail.com',
                '2024000005' => 'dianpermata@gmail.com',
                '2024000006' => 'ekasaputri@gmail.com',
                '2024000007' => 'fajarnugroho@gmail.com',
                '2024000008' => 'gitapuspita@gmail.com',
                '2024000009' => 'hendragunawan@gmail.com',
                '2024000010' => 'indahsari@gmail.com',
                default => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $mhs->nama)) . '@gmail.com',
            };
            
            User::updateOrCreate(
                ['email' => $emailMhs],
                [
                    'name' => $mhs->nama,
                    'password' => Hash::make('mahasiswa12345'),
                    'mahasiswa_id' => $mhs->npm,
                ]
            );
        }
    }
}