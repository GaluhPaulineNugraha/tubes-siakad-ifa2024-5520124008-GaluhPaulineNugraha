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
        // Hapus semua jadwal lama
        Jadwal::truncate();

        $dosen = Dosen::all();
        $matkul = Matakuliah::all();
        
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $kelas = ['A', 'B', 'C', 'D', 'E'];
        $jamList = [
            '2024-01-01 07:30:00',
            '2024-01-01 09:30:00',
            '2024-01-01 11:30:00',
            '2024-01-01 13:30:00',
            '2024-01-01 15:30:00',
        ];

        // SETIAP DOSEN DAPAT 2 MATA KULIAH
        $index = 0;
        foreach ($dosen as $d) {
            // Ambil 2 mata kuliah secara acak
            $matkulPilihan = $matkul->shuffle()->take(2);
            
            foreach ($matkulPilihan as $mk) {
                $hariIndex = $index % count($hari);
                $jamIndex = $index % count($jamList);
                $kelasIndex = $index % count($kelas);
                
                $existing = Jadwal::where('kode_matakuliah', $mk->kode_matakuliah)->first();
                
                if ($existing) {
                    $existing->update([
                        'nidn' => $d->nidn,
                        'kelas' => $kelas[$kelasIndex],
                        'hari' => $hari[$hariIndex],
                        'jam' => $jamList[$jamIndex],
                    ]);
                } else {
                    Jadwal::create([
                        'kode_matakuliah' => $mk->kode_matakuliah,
                        'nidn' => $d->nidn,
                        'kelas' => $kelas[$kelasIndex],
                        'hari' => $hari[$hariIndex],
                        'jam' => $jamList[$jamIndex],
                    ]);
                }
                $index++;
            }
        }

        // Jika ada matakuliah yang belum punya jadwal
        $matkulSudah = Jadwal::pluck('kode_matakuliah')->toArray();
        $matkulBelum = $matkul->whereNotIn('kode_matakuliah', $matkulSudah);
        
        foreach ($matkulBelum as $mk) {
            Jadwal::create([
                'kode_matakuliah' => $mk->kode_matakuliah,
                'nidn' => $dosen->random()->nidn,
                'kelas' => $kelas[rand(0, 4)],
                'hari' => $hari[rand(0, 5)],
                'jam' => $jamList[rand(0, 4)],
            ]);
        }
    }
}