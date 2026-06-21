<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nidn' => '1234567801', 'nama' => 'Dr. Ahmad Rizki, M.Kom'],
            ['nidn' => '1234567802', 'nama' => 'Prof. Siti Nurhaliza, M.Sc'],
            ['nidn' => '1234567803', 'nama' => 'Dr. Budi Santoso, M.Eng'],
            ['nidn' => '1234567804', 'nama' => 'Dewi Lestari, S.Kom, M.Kom'],
            ['nidn' => '1234567805', 'nama' => 'Dr. Eko Prasetyo, M.Kom'],
            ['nidn' => '1234567806', 'nama' => 'Dr. Fitriani Rahayu, M.Pd'],
            ['nidn' => '1234567807', 'nama' => 'Dr. Gatot Subroto, M.Kom'],
        ];
        
        foreach ($data as $d) {
            Dosen::updateOrCreate(
                ['nidn' => $d['nidn']],
                ['nama' => $d['nama']]
            );
        }
    }
}