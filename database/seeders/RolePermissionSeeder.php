<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'dosen']);
        Role::firstOrCreate(['name' => 'mahasiswa']);
        
        
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Universitas Nugraha',
                'password' => bcrypt('admin12345'),
            ]
        );
        $admin->assignRole('admin');
        
        
        $dosenList = Dosen::all();
        foreach ($dosenList as $dosen) {
            // Buat email dari nama (lowercase, tanpa spasi)
            $emailBase = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $dosen->nama));
            $email = $emailBase . '@gmail.com';
            
            // Cek jika email sudah ada, tambahkan angka
            $counter = 1;
            $originalEmail = $email;
            while (User::where('email', $email)->exists()) {
                $email = str_replace('@gmail.com', $counter . '@gmail.com', $originalEmail);
                $counter++;
            }
            
            $userDosen = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $dosen->nama,
                    'password' => bcrypt('dosen12345'),
                    'nidn' => $dosen->nidn,
                ]
            );
            $userDosen->assignRole('dosen');
        }
        
        
        $mahasiswaList = Mahasiswa::all();
        foreach ($mahasiswaList as $mhs) {
           
            $emailBase = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $mhs->nama));
            $email = $emailBase . '@gmail.com';
            
           
            $counter = 1;
            $originalEmail = $email;
            while (User::where('email', $email)->exists()) {
                $email = str_replace('@gmail.com', $counter . '@gmail.com', $originalEmail);
                $counter++;
            }
            
            $userMhs = User::updateOrCreate(
                ['email' => $email],
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