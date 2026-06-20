<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Dosen::all();
        $matkul = Matakuliah::all();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $kelas = ['A', 'B', 'C'];
        $jamList = [
            '2024-01-01 08:00:00',
            '2024-01-01 10:00:00',
            '2024-01-01 13:00:00',
            '2024-01-01 15:00:00',
        ];
        
        foreach ($matkul as $i => $mk) {
            Jadwal::create([
                'kode_matakuliah' => $mk->kode_matakuliah,
                'nidn' => $dosen->random()->nidn,
                'kelas' => $kelas[$i % 3],
                'hari' => $hari[$i % 5],
                'jam' => $jamList[$i % 4],
            ]);
        }
    }
}