<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nidn' => '1234567801', 'nama' => 'Dr. Ahmad Rizki, M.Kom', 'email' => 'ahmad.rizki@gmail.com'],
            ['nidn' => '1234567802', 'nama' => 'Prof. Siti Nurhaliza, M.Sc', 'email' => 'siti.nurhaliza@gmail.com'],
            ['nidn' => '1234567803', 'nama' => 'Dr. Budi Santoso, M.Eng', 'email' => 'budi.santoso@gmail.com'],
            ['nidn' => '1234567804', 'nama' => 'Dewi Lestari, S.Kom, M.Kom', 'email' => 'dewi.lestari@gmail.com'],
            ['nidn' => '1234567805', 'nama' => 'Dr. Eko Prasetyo, M.Kom', 'email' => 'eko.prasetyo@gmail.com'],
        ];
        
        foreach ($data as $d) {
            Dosen::updateOrCreate(
                ['nidn' => $d['nidn']],
                ['nama' => $d['nama'], 'email' => $d['email']]
            );
        }
    }
}