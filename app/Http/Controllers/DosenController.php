<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Models\KRS;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%");
        }
        
        $dosen = $query->paginate(10);
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosen|max:10',
            'nama' => 'required|max:50',
        ]);

        $emailBase = strtolower(str_replace(' ', '.', $validated['nama']));
        $email = $emailBase . '@gmail.com';
        $counter = 1;
        while (User::where('email', $email)->exists()) {
            $email = $emailBase . $counter . '@gmail.com';
            $counter++;
        }
        
        $dosen = Dosen::create([
            'nidn' => $validated['nidn'],
            'nama' => $validated['nama'],
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $email,
            'password' => Hash::make($validated['nidn']),
            'nidn' => $validated['nidn'],
        ]);
        $user->assignRole('dosen');

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan! Akun login: ' . $email . ' / Password: ' . $validated['nidn']);
    }

    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        
        $validated = $request->validate([
            'nama' => 'required|max:50',
        ]);

        $dosen->update([
            'nama' => $validated['nama'],
        ]);

        $user = User::where('nidn', $nidn)->first();
        if ($user) {
            $user->update([
                'name' => $validated['nama'],
            ]);
        }

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate');
    }

    public function destroy($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        User::where('nidn', $nidn)->delete();
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }

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