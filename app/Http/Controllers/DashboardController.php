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
        
        // CEK ROLE MANUAL (tanpa Spatie)
        $isAdmin = $user->email == 'admin@gmail.com';
        $isDosen = $user->nidn != null;
        $isMahasiswa = $user->mahasiswa_id != null;
        
        if ($isAdmin) {
            $totalDosen = Dosen::count();
            $totalMahasiswa = Mahasiswa::count();
            $totalMatakuliah = Matakuliah::count();
            $totalKRS = KRS::count();
            
            $totalSKS = KRS::with('matakuliah')->get()->sum(function($krs) {
                return $krs->matakuliah ? $krs->matakuliah->sks : 0;
            });
            
            $avgSksPerMhs = $totalMahasiswa > 0 ? round($totalSKS / $totalMahasiswa, 1) : 0;
            $activeKRS = KRS::distinct('npm')->count('npm');
            
            $latestDosen = Dosen::latest()->limit(5)->get();
            $latestMahasiswa = Mahasiswa::with('dosen')->latest()->limit(5)->get();
            
            return view('dashboard', compact(
                'totalDosen',
                'totalMahasiswa', 
                'totalMatakuliah',
                'totalKRS',
                'totalSKS',
                'avgSksPerMhs',
                'activeKRS',
                'latestDosen',
                'latestMahasiswa'
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
            $totalSks = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->get()
                ->sum(function($krs) {
                    return $krs->matakuliah ? $krs->matakuliah->sks : 0;
                });
            
            $latestKRS = KRS::with('matakuliah')
                ->where('npm', $mahasiswa->npm)
                ->latest()
                ->limit(5)
                ->get();
            
            return view('dashboard_mahasiswa', compact('mahasiswa', 'totalMatakuliah', 'totalSks', 'latestKRS'));
        }
        
        return view('dashboard');
    }
}