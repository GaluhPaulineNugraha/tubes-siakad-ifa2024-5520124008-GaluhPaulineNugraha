<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

   
    $email = strtolower(str_replace(' ', '', $validated['nama'])) . '@gmail.com';
    
   
    $mahasiswa = Mahasiswa::create([
        'npm' => $validated['npm'],
        'nidn' => $validated['nidn'],
        'nama' => $validated['nama'],
        'email' => $email, 
    ]);

    $user = User::create([
        'name' => $validated['nama'],
        'email' => $email,
        'password' => bcrypt($validated['npm']),
        'mahasiswa_id' => $validated['npm']
    ]);
    $user->assignRole('mahasiswa');

    return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa berhasil ditambahkan');
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
        $email = strtolower(str_replace(' ', '', $validated['nama'])) . '@gmail.com';
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
}