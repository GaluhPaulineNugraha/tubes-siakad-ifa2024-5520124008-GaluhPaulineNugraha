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
        
        // Daftar hari dan jam
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $kelas = ['A', 'B', 'C', 'D', 'E'];
        $jamMulai = [
            '07:30:00',
            '09:30:00', 
            '11:30:00',
            '13:30:00',
            '15:30:00',
        ];
        
        // Buat jadwal untuk SEMUA mata kuliah
        foreach ($matkul as $index => $mk) {
            // Gunakan index untuk menentukan hari dan jam secara bergantian
            $hariIndex = $index % count($hari);
            $jamIndex = $index % count($jamMulai);
            $kelasIndex = $index % count($kelas);
            
            // Buat timestamp dengan tanggal dummy (hanya waktu yang dipakai)
            $jamTimestamp = '2024-01-01 ' . $jamMulai[$jamIndex];
            
            Jadwal::updateOrCreate(
                ['kode_matakuliah' => $mk->kode_matakuliah],
                [
                    'nidn' => $dosen->random()->nidn,
                    'kelas' => $kelas[$kelasIndex],
                    'hari' => $hari[$hariIndex],
                    'jam' => $jamTimestamp,
                ]
            );
        }
    }
}