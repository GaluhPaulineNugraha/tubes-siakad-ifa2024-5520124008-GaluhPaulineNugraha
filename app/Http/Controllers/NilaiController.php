<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiExport;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        $isDosen = $user->nidn != null;
        $isMahasiswa = $user->mahasiswa_id != null;
        
        if ($isAdmin) {
            // ADMIN: Lihat semua nilai
            $query = KRS::with(['mahasiswa', 'matakuliah']);
            
            if ($request->search) {
                $query->whereHas('mahasiswa', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('npm', 'like', "%{$request->search}%");
                });
            }
            
            $nilai = $query->orderBy('npm', 'asc')->paginate(10);
            return view('nilai.index', compact('nilai'));
        }
        
        if ($isDosen) {
            // DOSEN: Lihat nilai mahasiswa bimbingan (READ ONLY)
            $dosen = Dosen::where('nidn', $user->nidn)->first();
            
            if (!$dosen) {
                return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
            }
            
            $mahasiswaIds = Mahasiswa::where('nidn', $dosen->nidn)->pluck('npm');
            
            $query = KRS::with(['mahasiswa', 'matakuliah'])
                ->whereIn('npm', $mahasiswaIds);
            
            if ($request->search) {
                $query->whereHas('mahasiswa', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('npm', 'like', "%{$request->search}%");
                });
            }
            
            $nilai = $query->orderBy('npm', 'asc')->paginate(10);
            return view('nilai.dosen', compact('nilai', 'dosen'));
        }
        
        if ($isMahasiswa) {
            // MAHASISWA: Lihat nilai sendiri
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            $nilai = KRS::with(['matakuliah'])
                ->where('npm', $mahasiswa->npm)
                ->get();
            
            return view('nilai.mahasiswa', compact('nilai', 'mahasiswa'));
        }
        
        return view('nilai.index');
    }

    public function exportExcel()
    {
        return Excel::download(new NilaiExport, 'data_nilai_' . date('Ymd_His') . '.xlsx');
    }
}