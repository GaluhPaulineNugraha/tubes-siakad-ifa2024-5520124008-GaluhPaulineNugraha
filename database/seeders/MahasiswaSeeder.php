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
            ['npm' => '2024000011', 'nama' => 'Joko Prasetyo'],
            ['npm' => '2024000012', 'nama' => 'Kartika Dewi'],
            ['npm' => '2024000013', 'nama' => 'Lukman Hakim'],
            ['npm' => '2024000014', 'nama' => 'Maya Sari'],
            ['npm' => '2024000015', 'nama' => 'Nanda Pratama'],
            ['npm' => '2024000016', 'nama' => 'Oki Setiawan'],
            ['npm' => '2024000017', 'nama' => 'Putri Ayu'],
            ['npm' => '2024000018', 'nama' => 'Qori Fadhilah'],
            ['npm' => '2024000019', 'nama' => 'Rahmat Hidayat'],
            ['npm' => '2024000020', 'nama' => 'Siti Rahmah'],
            ['npm' => '2024000021', 'nama' => 'Taufik Hidayat'],
            ['npm' => '2024000022', 'nama' => 'Umi Kalsum'],
            ['npm' => '2024000023', 'nama' => 'Vina Anggraini'],
            ['npm' => '2024000024', 'nama' => 'Wahyu Pratama'],
            ['npm' => '2024000025', 'nama' => 'Xena Amanda'],
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