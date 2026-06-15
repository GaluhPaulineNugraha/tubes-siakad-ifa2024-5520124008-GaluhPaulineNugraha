<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\KRS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    // HAPUS __construct() INI:
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:dosen');
    // }

    public function dashboard()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        
        // Statistik
        $totalMahasiswaBimbingan = Mahasiswa::where('nidn', $dosen->nidn)->count();
        $totalJadwalMengajar = Jadwal::where('nidn', $dosen->nidn)->count();
        $totalKRS = KRS::whereIn('npm', Mahasiswa::where('nidn', $dosen->nidn)->pluck('npm'))->count();
        
        // Data terbaru
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

    public function jadwalIndex()
    {
        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();
        
        $jadwal = Jadwal::with(['matakuliah'])
            ->where('nidn', $dosen->nidn)
            ->paginate(10);
            
        return view('dosen.jadwal', compact('jadwal'));
    }

    public function jadwalCreate()
    {
        $matakuliah = Matakuliah::all();
        return view('dosen.jadwal_create', compact('matakuliah'));
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas' => 'required|in:A,B,C,D,E',
            'ruangan' => 'nullable|max:50',
        ]);

        $user = Auth::user();
        $dosen = Dosen::where('nidn', $user->nidn)->first();

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn' => $dosen->nidn,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kelas' => $request->kelas,
            'ruangan' => $request->ruangan,
        ]);

        return redirect()->route('dosen.jadwal')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function jadwalEdit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $matakuliah = Matakuliah::all();
        return view('dosen.jadwal_edit', compact('jadwal', 'matakuliah'));
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas' => 'required|in:A,B,C,D,E',
            'ruangan' => 'nullable|max:50',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('dosen.jadwal')->with('success', 'Jadwal berhasil diupdate');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dosen.jadwal')->with('success', 'Jadwal berhasil dihapus');
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