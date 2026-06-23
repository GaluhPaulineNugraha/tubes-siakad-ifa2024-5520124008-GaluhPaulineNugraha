<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        
        if ($isAdmin) {
            $query = Krs::with(['mahasiswa', 'matakuliah']);
            
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
        
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }
        
        $krsList = Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah');
        
        $jadwal = Jadwal::with(['matakuliah', 'dosen'])
            ->whereIn('kode_matakuliah', $krsList)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam')
            ->get();
        
        return view('jadwal.mahasiswa', compact('jadwal', 'mahasiswa'));
    }

    public function exportPdf()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }
        
        $krsList = Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah');
        
        $jadwal = Jadwal::with(['matakuliah', 'dosen'])
            ->whereIn('kode_matakuliah', $krsList)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam')
            ->get();
        
        $pdf = Pdf::loadView('jadwal.pdf', compact('jadwal', 'mahasiswa'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Jadwal_Kuliah_' . $mahasiswa->npm . '_' . date('Ymd') . '.pdf');
    }
}