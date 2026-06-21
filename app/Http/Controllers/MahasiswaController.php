<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use App\Models\KRS;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('dosen');
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }
        
        $mahasiswa = $query->orderBy('npm')->paginate(10);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        return view('mahasiswa.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswa|max:10',
            'nidn' => 'required|exists:dosen,nidn',
            'nama' => 'required|max:50',
        ]);

        $emailBase = strtolower(str_replace(' ', '', $validated['nama']));
        $email = $emailBase . '@gmail.com';
        
        $counter = 1;
        while (User::where('email', $email)->exists()) {
            $email = $emailBase . $counter . '@gmail.com';
            $counter++;
        }
        
        $mahasiswa = Mahasiswa::create([
            'npm' => $validated['npm'],
            'nidn' => $validated['nidn'],
            'nama' => $validated['nama'],
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $email,
            'password' => Hash::make($validated['npm']),
            'mahasiswa_id' => $validated['npm'],
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan! Akun login: ' . $email . ' / Password: ' . $validated['npm']);
    }

    public function edit($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosen = Dosen::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosen'));
    }

    public function update(Request $request, $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        
        $validated = $request->validate([
            'npm' => ['required', 'max:10', Rule::unique('mahasiswa')->ignore($mahasiswa->npm, 'npm')],
            'nidn' => 'required|exists:dosen,nidn',
            'nama' => 'required|max:50',
        ]);
        
        $mahasiswa->update([
            'npm' => $validated['npm'],
            'nidn' => $validated['nidn'],
            'nama' => $validated['nama'],
        ]);
        
        $user = User::where('mahasiswa_id', $npm)->first();
        if ($user) {
            $emailBase = strtolower(str_replace(' ', '', $validated['nama']));
            $email = $emailBase . '@gmail.com';
            $counter = 1;
            while (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
                $email = $emailBase . $counter . '@gmail.com';
                $counter++;
            }
            
            $user->update([
                'name' => $validated['nama'],
                'email' => $email,
            ]);
        }
        
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diupdate');
    }

    public function destroy($npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        User::where('mahasiswa_id', $npm)->delete();
        $mahasiswa->delete();
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'data_mahasiswa_' . date('Ymd_His') . '.xlsx');
    }
}