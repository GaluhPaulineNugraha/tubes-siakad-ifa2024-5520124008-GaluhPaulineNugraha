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
        $jamMulai = ['08:00', '10:00', '13:00', '15:00'];
        $jamSelesai = ['09:40', '11:40', '14:40', '16:40'];
        
        foreach ($matkul as $i => $mk) {
            Jadwal::create([
                'kode_matakuliah' => $mk->kode_matakuliah,
                'nidn' => $dosen->random()->nidn,
                'kelas' => $kelas[$i % 3],
                'hari' => $hari[$i % 5],
                'jam_mulai' => $jamMulai[$i % 4],
                'jam_selesai' => $jamSelesai[$i % 4],
                'ruangan' => 'R.' . chr(65 + ($i % 5)) . ($i + 1),
            ]);
        }
    }
}