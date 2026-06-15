<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Dosen::all();
        
        $data = [
            ['npm' => '2024000001', 'nama' => 'Galuh Pauline Nugraha', 'email' => 'galuh.pauline@gmail.com'],
            ['npm' => '2024000002', 'nama' => 'Andi Saputra', 'email' => 'andi.saputra@gmail.com'],
            ['npm' => '2024000003', 'nama' => 'Budi Wijaya', 'email' => 'budi.wijaya@gmail.com'],
            ['npm' => '2024000004', 'nama' => 'Citra Amalia', 'email' => 'citra.amalia@gmail.com'],
            ['npm' => '2024000005', 'nama' => 'Dian Permata', 'email' => 'dian.permata@gmail.com'],
            ['npm' => '2024000006', 'nama' => 'Eka Saputri', 'email' => 'eka.saputri@gmail.com'],
            ['npm' => '2024000007', 'nama' => 'Fajar Nugroho', 'email' => 'fajar.nugroho@gmail.com'],
            ['npm' => '2024000008', 'nama' => 'Gita Puspita', 'email' => 'gita.puspita@gmail.com'],
            ['npm' => '2024000009', 'nama' => 'Hendra Gunawan', 'email' => 'hendra.gunawan@gmail.com'],
            ['npm' => '2024000010', 'nama' => 'Indah Sari', 'email' => 'indah.sari@gmail.com'],
        ];
        
        foreach ($data as $mhs) {
            Mahasiswa::updateOrCreate(
                ['npm' => $mhs['npm']],
                [
                    'nidn' => $dosen->random()->nidn,
                    'nama' => $mhs['nama'],
                    'email' => $mhs['email'],
                ]
            );
        }
    }
}