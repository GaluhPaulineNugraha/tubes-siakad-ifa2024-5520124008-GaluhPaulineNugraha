<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::query();
        
        if ($request->search) {
            $query->where('nama_matakuliah', 'like', "%{$request->search}%")
                  ->orWhere('kode_matakuliah', 'like', "%{$request->search}%");
        }
        
        $matakuliah = $query->orderBy('kode_matakuliah')->paginate(10);
        
        // Debug: cek apakah data ada
        // dd($matakuliah); // Uncomment untuk cek
        
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|unique:matakuliah|max:8',
            'nama_matakuliah' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        Matakuliah::create($validated);
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function edit($kode)
    {
        $matakuliah = Matakuliah::findOrFail($kode);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $kode)
    {
        $matakuliah = Matakuliah::findOrFail($kode);
        
        $validated = $request->validate([
            'kode_matakuliah' => ['required', 'max:8', Rule::unique('matakuliah')->ignore($matakuliah->kode_matakuliah, 'kode_matakuliah')],
            'nama_matakuliah' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $matakuliah->update($validated);
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil diupdate');
    }

    public function destroy($kode)
    {
        $matakuliah = Matakuliah::findOrFail($kode);
        $matakuliah->delete();
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil dihapus');
    }
}