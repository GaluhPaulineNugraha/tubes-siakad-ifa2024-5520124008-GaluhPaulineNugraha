<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\KRS;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        if ($user->hasRole('admin')) {
            // Data statistik utama
            $totalDosen = Dosen::count();
            $totalMahasiswa = Mahasiswa::count();
            $totalMatakuliah = Matakuliah::count();
            $totalKRS = KRS::count();
            
            // Total SKS terambil
            $totalSKS = KRS::with('matakuliah')->get()->sum(function($krs) {
                return $krs->matakuliah ? $krs->matakuliah->sks : 0;
            });
            
            // Rata-rata SKS per mahasiswa
            $avgSksPerMhs = $totalMahasiswa > 0 ? round($totalSKS / $totalMahasiswa, 1) : 0;
            
            // Mahasiswa yang sudah mengambil KRS
            $activeKRS = KRS::distinct('npm')->count('npm');
            
            // Data terbaru
            $latestDosen = Dosen::latest()->limit(5)->get();
            $latestMahasiswa = Mahasiswa::with('dosen')->latest()->limit(5)->get();
            
            // My Courses untuk admin (bisa diisi static atau dari database)
            $myCourses = [
                'BASDAT A B 24',
                'BASDAT A 24',
                'MULTI A 24',
                'KOMDAT A 24',
                'RPL A 24',
                'IMK A 24',
                'JARKOM A 24',
                'IT G A 24'
            ];
            
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
                'myCourses'
            ));
        }
        
        if ($user->hasRole('mahasiswa')) {
            // Data untuk mahasiswa
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            
            if (!$mahasiswa) {
                return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
            }
            
            // Total mata kuliah yang diambil
            $totalMatakuliah = KRS::where('npm', $mahasiswa->npm)->count();
            
            // Total SKS yang diambil
            $totalSks = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->get()
                ->sum(function($krs) {
                    return $krs->matakuliah ? $krs->matakuliah->sks : 0;
                });
            
            // Mata kuliah terbaru yang diambil
            $latestKRS = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->latest()
                ->limit(5)
                ->get();
            
            // My Courses - Mata kuliah yang diambil mahasiswa
            $myCourses = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->get()
                ->map(function($krs) {
                    return $krs->matakuliah ? $krs->matakuliah->nama_matakuliah : '';
                })
                ->filter()
                ->values()
                ->toArray();
            
            return view('dashboard', compact(
                'mahasiswa', 
                'totalMatakuliah', 
                'totalSks', 
                'latestKRS',
                'myCourses'
            ));
        }
        
        return view('dashboard');
    }
}