<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        $isDosen = $user->nidn != null;
        $isMahasiswa = $user->mahasiswa_id != null;
        
        if ($isAdmin) {
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
            $dosen = Dosen::where('user_id', $user->id)->first();
            
            if (!$dosen) {
                $dosen = Dosen::where('nidn', $user->nidn)->first();
            }
            
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
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            $nilai = KRS::with(['matakuliah'])
                ->where('npm', $mahasiswa->npm)
                ->get();
            
            return view('nilai.mahasiswa', compact('nilai', 'mahasiswa'));
        }
        
        return view('nilai.index');
    }
    
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $isDosen = $user->nidn != null;
        
        if (!$isDosen) {
            return redirect()->back()->with('error', 'Hanya dosen yang dapat mengedit nilai');
        }
        
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);
        
        $krs = KRS::findOrFail($id);
        
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        $mahasiswa = Mahasiswa::where('npm', $krs->npm)->first();
        
        if (!$dosen || $mahasiswa->nidn != $dosen->nidn) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke nilai mahasiswa ini');
        }
        
        $nilai = $request->nilai;
        
        if ($nilai >= 85) {
            $grade = 'A';
            $status = 'Lulus';
        } elseif ($nilai >= 75) {
            $grade = 'B';
            $status = 'Lulus';
        } elseif ($nilai >= 65) {
            $grade = 'C';
            $status = 'Perbaikan';
        } elseif ($nilai >= 55) {
            $grade = 'D';
            $status = 'Tidak Lulus';
        } else {
            $grade = 'E';
            $status = 'Tidak Lulus';
        }
        
        $krs->update([
            'nilai' => $nilai,
            'grade' => $grade,
            'status' => $status
        ]);
        
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diupdate');
    }
}