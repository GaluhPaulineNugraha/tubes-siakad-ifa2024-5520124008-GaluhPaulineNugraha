<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JadwalExport;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['matakuliah', 'dosen']);
        
        if ($request->search) {
            $query->whereHas('matakuliah', function($q) use ($request) {
                $q->where('nama_matakuliah', 'like', "%{$request->search}%");
            })->orWhereHas('dosen', function($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%");
            });
        }
        
        // SORTING: Berdasarkan Hari (Senin - Jumat) lalu Jam
        $hariOrder = "FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')";
        $jadwal = $query->orderByRaw($hariOrder)
                        ->orderBy('jam')
                        ->get();
        
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('admin.jadwal.create', compact('dosen', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|in:A,B,C,D,E',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam' => 'required',
        ]);

        $jamInput = date('H:i', strtotime($request->jam));

        $bentrok = Jadwal::where('hari', $request->hari)
            ->where('kelas', $request->kelas)
            ->whereRaw("TIME_FORMAT(jam, '%H:%i') = ?", [$jamInput])
            ->exists();

        if ($bentrok) {
            return back()->with('error', 'Jadwal bentrok! Pada hari ' . $request->hari . ', kelas ' . $request->kelas . ' jam ' . $jamInput . ' sudah terisi.')
                   ->withInput();
        }

        $jam = date('Y-m-d H:i:s', strtotime($request->jam));

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn' => $request->nidn,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam' => $jam,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $dosen = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dosen', 'matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|in:A,B,C,D,E',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam' => 'required',
        ]);

        $jamInput = date('H:i', strtotime($request->jam));

        $bentrok = Jadwal::where('hari', $request->hari)
            ->where('kelas', $request->kelas)
            ->whereRaw("TIME_FORMAT(jam, '%H:%i') = ?", [$jamInput])
            ->where('id', '!=', $id)
            ->exists();

        if ($bentrok) {
            return back()->with('error', 'Jadwal bentrok! Pada hari ' . $request->hari . ', kelas ' . $request->kelas . ' jam ' . $jamInput . ' sudah terisi.')
                   ->withInput();
        }

        $jadwal = Jadwal::findOrFail($id);
        
        $jam = date('Y-m-d H:i:s', strtotime($request->jam));

        $jadwal->update([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn' => $request->nidn,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam' => $jam,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new JadwalExport, 'data_jadwal_' . date('Ymd_His') . '.xlsx');
    }
}