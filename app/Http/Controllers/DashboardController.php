<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\KRS;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // CEK ROLE
        $isAdmin = $user->email == 'admin@gmail.com';
        $isDosen = $user->nidn != null;
        $isMahasiswa = $user->mahasiswa_id != null;
        
        if ($isAdmin) {
            $totalDosen = Dosen::count();
            $totalMahasiswa = Mahasiswa::count();
            $totalMatakuliah = Matakuliah::count();
            $totalKRS = KRS::count();
            
            // Hitung total SKS
            $totalSKS = 0;
            $allKrs = KRS::with('matakuliah')->get();
            foreach ($allKrs as $krs) {
                if ($krs->matakuliah) {
                    $totalSKS += $krs->matakuliah->sks;
                }
            }
            
            $avgSksPerMhs = $totalMahasiswa > 0 ? round($totalSKS / $totalMahasiswa, 1) : 0;
            $activeKRS = KRS::distinct('npm')->count('npm');
            
            $latestDosen = Dosen::latest()->limit(5)->get();
            $latestMahasiswa = Mahasiswa::with('dosen')->latest()->limit(5)->get();
            
            // ==========================================
            // DATA GRAFIK JADWAL PER HARI
            // ==========================================
            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $jadwalPerHari = [];
            foreach ($hariList as $hari) {
                $jadwalPerHari[] = Jadwal::where('hari', $hari)->count();
            }
            
            // ==========================================
            // DATA GRAFIK MAHASISWA PER DOSEN WALI
            // ==========================================
            $dosenList = Dosen::withCount('mahasiswa')->get();
            $dosenWaliLabels = [];
            $mahasiswaPerDosen = [];
            
            foreach ($dosenList as $dosen) {
                // Ambil nama singkat (maksimal 20 karakter)
                $namaSingkat = strlen($dosen->nama) > 20 ? substr($dosen->nama, 0, 18) . '..' : $dosen->nama;
                $dosenWaliLabels[] = $namaSingkat;
                $mahasiswaPerDosen[] = $dosen->mahasiswa_count;
            }
            
            return view('dashboard', compact(
                'totalDosen',
                'totalMahasiswa', 
                'totalMatakuliah',
                'totalKRS',
                'totalSKS',
                'avgSksPerMhs',
                'activeKRS',
                'latestDosen',
                'latestMahasiswa',
                'jadwalPerHari',
                'dosenWaliLabels',
                'mahasiswaPerDosen'
            ));
        }
        
        if ($isDosen) {
            return redirect()->route('dosen.dashboard');
        }
        
        if ($isMahasiswa) {
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            
            if (!$mahasiswa) {
                return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
            }
            
            $totalMatakuliah = KRS::where('npm', $mahasiswa->npm)->count();
            
            $totalSks = 0;
            $krsList = KRS::with('matakuliah')->where('npm', $mahasiswa->npm)->get();
            foreach ($krsList as $krs) {
                if ($krs->matakuliah) {
                    $totalSks += $krs->matakuliah->sks;
                }
            }
            
            $latestKRS = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->latest()
                ->limit(5)
                ->get();
            
            return view('dashboard_mahasiswa', compact('mahasiswa', 'totalMatakuliah', 'totalSks', 'latestKRS'));
        }
        
        return view('dashboard');
    }
    
    // API untuk refresh chart (AJAX)
    public function chartJadwal()
    {
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data = [];
        foreach ($hariList as $hari) {
            $data[] = Jadwal::where('hari', $hari)->count();
        }
        return response()->json($data);
    }
    
    public function chartMahasiswa()
    {
        $dosenList = Dosen::withCount('mahasiswa')->get();
        $data = [];
        foreach ($dosenList as $dosen) {
            $data[] = $dosen->mahasiswa_count;
        }
        return response()->json($data);
    }
}