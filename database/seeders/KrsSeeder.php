<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = Mahasiswa::all();
        $matkul = Matakuliah::all();
        
        foreach ($mahasiswa as $mhs) {
            $ambil = $matkul->random(rand(4, 6));
            foreach ($ambil as $mk) {
                Krs::updateOrCreate(
                    [
                        'npm' => $mhs->npm,
                        'kode_matakuliah' => $mk->kode_matakuliah,
                    ],
                    []
                );
            }
        }
    }
}