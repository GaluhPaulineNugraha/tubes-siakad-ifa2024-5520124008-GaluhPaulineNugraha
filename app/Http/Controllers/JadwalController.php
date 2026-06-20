<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\KRS;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        
        if ($isAdmin) {
            $query = KRS::with(['mahasiswa', 'matakuliah']);
            
            if ($request->search) {
                $query->whereHas('mahasiswa', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('npm', 'like', "%{$request->search}%");
                });
            }
            
            $jadwal = $query->orderBy('npm', 'asc')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
            
            return view('jadwal.index', compact('jadwal'));
        }
        
        // UNTUK MAHASISWA
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }
        
        // Ambil KRS mahasiswa
        $krsList = KRS::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah');
        
        // Ambil jadwal berdasarkan mata kuliah yang diambil mahasiswa
        $jadwal = Jadwal::with(['matakuliah', 'dosen'])
            ->whereIn('kode_matakuliah', $krsList)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam')
            ->get();
        
        return view('jadwal.mahasiswa', compact('jadwal', 'mahasiswa'));
    }
}