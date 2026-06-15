<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            $query = KRS::with(['mahasiswa', 'matakuliah']);
            
            if ($request->search) {
                $query->whereHas('mahasiswa', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('npm', 'like', "%{$request->search}%");
                });
            }
            
            // Urutkan berdasarkan NPM (A-Z)
            $jadwal = $query->orderBy('npm', 'asc')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
            
            return view('jadwal.index', compact('jadwal'));
        }
        
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        $jadwal = KRS::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->get();
        
        return view('jadwal.mahasiswa', compact('jadwal', 'mahasiswa'));
    }
}