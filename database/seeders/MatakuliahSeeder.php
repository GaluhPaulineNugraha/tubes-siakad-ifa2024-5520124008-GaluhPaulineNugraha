<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_matakuliah' => 'IF53401', 'nama_matakuliah' => 'Pemrograman Dasar', 'sks' => 3],
            ['kode_matakuliah' => 'IF53402', 'nama_matakuliah' => 'Algoritma dan Struktur Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF53403', 'nama_matakuliah' => 'Basis Data I', 'sks' => 3],
            ['kode_matakuliah' => 'IF53404', 'nama_matakuliah' => 'Pemrograman Web', 'sks' => 3],
            ['kode_matakuliah' => 'IF53405', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 3],
            ['kode_matakuliah' => 'IF53406', 'nama_matakuliah' => 'Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF53407', 'nama_matakuliah' => 'Basis Data II', 'sks' => 3],
            ['kode_matakuliah' => 'IF53408', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
            ['kode_matakuliah' => 'IF53409', 'nama_matakuliah' => 'Pemrograman Mobile', 'sks' => 3],
            ['kode_matakuliah' => 'IF53410', 'nama_matakuliah' => 'Kecerdasan Buatan', 'sks' => 3],
        ];
        
        foreach ($data as $mk) {
            Matakuliah::updateOrCreate(
                ['kode_matakuliah' => $mk['kode_matakuliah']],
                ['nama_matakuliah' => $mk['nama_matakuliah'], 'sks' => $mk['sks']]
            );
        }
    }
}