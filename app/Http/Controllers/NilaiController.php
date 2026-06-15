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
        
        if ($user->hasRole('admin')) {
            // ADMIN: Hanya bisa melihat nilai (tidak bisa edit)
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
        
        if ($user->hasRole('dosen')) {
            // DOSEN WALI: Bisa edit nilai mahasiswa bimbingannya
            $dosen = Dosen::where('user_id', $user->id)->first();
            
            if (!$dosen) {
                return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan');
            }
            
            // Ambil mahasiswa bimbingan dosen ini
            $mahasiswaIds = Mahasiswa::where('dosen_id', $dosen->id)->pluck('npm');
            
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
        
        if ($user->hasRole('mahasiswa')) {
            // MAHASISWA: Hanya bisa melihat nilai sendiri
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            $nilai = KRS::with(['matakuliah'])
                ->where('npm', $mahasiswa->npm)
                ->get();
            
            return view('nilai.mahasiswa', compact('nilai', 'mahasiswa'));
        }
        
        return view('nilai.index');
    }
    
    // DOSEN SAJA yang bisa update nilai
    public function update(Request $request, $id)
    {
        // Cek apakah user adalah dosen
        if (!Auth::user()->hasRole('dosen')) {
            return redirect()->back()->with('error', 'Hanya dosen yang dapat mengedit nilai');
        }
        
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);
        
        $krs = KRS::findOrFail($id);
        
        // Cek apakah dosen ini adalah wali dari mahasiswa tersebut
        $dosen = Dosen::where('user_id', Auth::user()->id)->first();
        $mahasiswa = Mahasiswa::where('npm', $krs->npm)->first();
        
        if (!$dosen || $mahasiswa->dosen_id != $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke nilai mahasiswa ini');
        }
        
        $nilai = $request->nilai;
        
        // Tentukan grade berdasarkan nilai
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