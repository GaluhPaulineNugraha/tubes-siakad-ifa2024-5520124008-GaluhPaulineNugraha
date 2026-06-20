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
            ['npm' => '2024000001', 'nama' => 'Galuh Pauline Nugraha'],
            ['npm' => '2024000002', 'nama' => 'Andi Saputra'],
            ['npm' => '2024000003', 'nama' => 'Budi Wijaya'],
            ['npm' => '2024000004', 'nama' => 'Citra Amalia'],
            ['npm' => '2024000005', 'nama' => 'Dian Permata'],
            ['npm' => '2024000006', 'nama' => 'Eka Saputri'],
            ['npm' => '2024000007', 'nama' => 'Fajar Nugroho'],
            ['npm' => '2024000008', 'nama' => 'Gita Puspita'],
            ['npm' => '2024000009', 'nama' => 'Hendra Gunawan'],
            ['npm' => '2024000010', 'nama' => 'Indah Sari'],
        ];
        
        foreach ($data as $mhs) {
            Mahasiswa::updateOrCreate(
                ['npm' => $mhs['npm']],
                [
                    'nidn' => $dosen->random()->nidn,
                    'nama' => $mhs['nama'],
                ]
            );
        }
    }
}