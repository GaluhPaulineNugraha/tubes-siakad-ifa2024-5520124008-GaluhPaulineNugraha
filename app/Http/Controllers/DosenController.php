<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Models\KRS;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        
        $totalMahasiswaBimbingan = Mahasiswa::where('nidn', $dosen->nidn)->count();
        $totalJadwalMengajar = Jadwal::where('nidn', $dosen->nidn)->count();
        $totalKRS = KRS::whereIn('npm', Mahasiswa::where('nidn', $dosen->nidn)->pluck('npm'))->count();
        
        $jadwalTerbaru = Jadwal::with(['matakuliah'])
            ->where('nidn', $dosen->nidn)
            ->latest()
            ->limit(5)
            ->get();
            
        $mahasiswaBimbingan = Mahasiswa::where('nidn', $dosen->nidn)
            ->latest()
            ->limit(5)
            ->get();
        
        return view('dosen.dashboard', compact(
            'dosen',
            'totalMahasiswaBimbingan',
            'totalJadwalMengajar',
            'totalKRS',
            'jadwalTerbaru',
            'mahasiswaBimbingan'
        ));
    }

    // Hanya untuk melihat jadwal (tidak bisa tambah/edit/hapus)
    public function jadwalIndex()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        
        $jadwal = Jadwal::with(['matakuliah'])
            ->where('nidn', $dosen->nidn)
            ->paginate(10);
            
        return view('dosen.jadwal', compact('jadwal'));
    }

    public function mahasiswaIndex()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        
        $mahasiswa = Mahasiswa::where('nidn', $dosen->nidn)
            ->paginate(10);
            
        return view('dosen.mahasiswa', compact('mahasiswa', 'dosen'));
    }
}