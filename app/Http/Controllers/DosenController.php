<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();
        
        if ($request->search) {
            $query->where('nama', 'like', "%{$request->search}%")
                  ->orWhere('nidn', 'like', "%{$request->search}%");
        }
        
        $dosen = $query->orderBy('created_at', 'desc')->paginate(10);
        
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
        
        // Tambahkan email otomatis jika diperlukan
        $validated['email'] = $request->email ?? $validated['nidn'] . '@dosen.universitas.ac.id';
        
        Dosen::create($validated);
        
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }
    
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        
        $validated = $request->validate([
            'nidn' => 'required|max:10|unique:dosen,nidn,' . $id,
            'nama' => 'required|max:50',
        ]);
        
        $dosen->update($validated);
        
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}