<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'dosen']);
        Role::firstOrCreate(['name' => 'mahasiswa']);
        
        // ADMIN
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Universitas Nugraha',
                'password' => bcrypt('admin12345'),
            ]
        );
        $admin->assignRole('admin');
        
        // DOSEN
        $dosenList = Dosen::all();
        foreach ($dosenList as $dosen) {
            $userDosen = User::updateOrCreate(
                ['email' => $dosen->nama . '@gmail.com'],
                [
                    'name' => $dosen->nama,
                    'password' => bcrypt('dosen12345'),
                    'nidn' => $dosen->nidn,
                ]
            );
            $userDosen->assignRole('dosen');
        }
        
        // MAHASISWA
        $mahasiswaList = Mahasiswa::all();
        foreach ($mahasiswaList as $mhs) {
            $userMhs = User::updateOrCreate(
                ['email' => $mhs->nama . '@gmail.com'],
                [
                    'name' => $mhs->nama,
                    'password' => bcrypt('mahasiswa12345'),
                    'mahasiswa_id' => $mhs->npm,
                ]
            );
            $userMhs->assignRole('mahasiswa');
        }
    }
}