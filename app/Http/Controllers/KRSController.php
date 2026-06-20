<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KRSExport;

class KRSController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        
        if ($isAdmin) {
            $query = KRS::with(['mahasiswa.dosen', 'matakuliah']);
            
            if ($request->search) {
                $query->whereHas('mahasiswa', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->search}%")
                      ->orWhere('npm', 'like', "%{$request->search}%");
                });
            }
            
            if ($request->mahasiswa_id) {
                $query->where('npm', $request->mahasiswa_id);
            }
            
            $krsList = $query->orderBy('npm', 'asc')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
            
            $mahasiswa = Mahasiswa::all();
            
            $totalSks = KRS::with('matakuliah')->get()->sum(function($krs) {
                return $krs->matakuliah ? $krs->matakuliah->sks : 0;
            });
            
            return view('krs.admin_index', compact('krsList', 'mahasiswa', 'totalSks'));
        } else {
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            
            if (!$mahasiswa) {
                return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
            }
            
            $krsList = KRS::with(['matakuliah'])
                ->where('npm', $mahasiswa->npm)
                ->orderBy('created_at', 'desc')
                ->get();
            
            $ambilMatkul = Matakuliah::whereNotIn('kode_matakuliah', $krsList->pluck('kode_matakuliah'))->get();
            
            $totalSks = 0;
            foreach ($krsList as $krs) {
                if ($krs->matakuliah) {
                    $totalSks += $krs->matakuliah->sks;
                }
            }
            
            return view('krs.mahasiswa_index', compact('krsList', 'ambilMatkul', 'totalSks', 'mahasiswa'));
        }
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah'
        ]);
        
        $exists = KRS::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();
            
        if ($exists) {
            return back()->with('error', 'Mata kuliah sudah diambil!');
        }
        
        $currentSks = 0;
        $krsList = KRS::with('matakuliah')->where('npm', $mahasiswa->npm)->get();
        foreach ($krsList as $krs) {
            if ($krs->matakuliah) {
                $currentSks += $krs->matakuliah->sks;
            }
        }
        
        $matakuliah = Matakuliah::find($validated['kode_matakuliah']);
        
        if ($currentSks + $matakuliah->sks > 24) {
            return back()->with('error', '❌ Total SKS melebihi batas maksimal 24 SKS! Anda sudah mengambil ' . $currentSks . ' SKS, sisa kuota ' . (24 - $currentSks) . ' SKS.');
        }
        
        KRS::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $validated['kode_matakuliah']
        ]);
        
        return redirect()->route('krs.index')->with('success', '✅ Mata kuliah berhasil ditambahkan ke KRS');
    }
    
    public function destroy($id)
    {
        $krs = KRS::findOrFail($id);
        $user = Auth::user();
        $isAdmin = $user->email == 'admin@gmail.com';
        
        if (!$isAdmin) {
            $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
            if ($krs->npm != $mahasiswa->npm) {
                abort(403);
            }
        }
        
        $krs->delete();
        
        if ($isAdmin) {
            return redirect()->route('krs.admin')->with('success', 'KRS berhasil dihapus');
        }
        
        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil dihapus dari KRS');
    }
    
    public function exportPdf()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('npm', $user->mahasiswa_id)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }
        
        $krsList = KRS::with(['matakuliah'])
            ->where('npm', $mahasiswa->npm)
            ->get();
        
        $totalSks = 0;
        foreach ($krsList as $krs) {
            if ($krs->matakuliah) {
                $totalSks += $krs->matakuliah->sks;
            }
        }
        
        $pdf = Pdf::loadView('krs.pdf', compact('krsList', 'mahasiswa', 'totalSks'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('KRS_' . $mahasiswa->npm . '_' . date('Ymd') . '.pdf');
    }
    
    public function exportExcel()
    {
        try {
            $krsList = KRS::with(['mahasiswa.dosen', 'matakuliah'])->get();
            
            $data = [];
            $no = 1;
            
            foreach ($krsList as $krs) {
                $data[] = [
                    $no++,
                    $krs->mahasiswa->npm ?? '-',
                    $krs->mahasiswa->nama ?? '-',
                    $krs->mahasiswa->dosen->nama ?? '-',
                    $krs->matakuliah->kode_matakuliah ?? '-',
                    $krs->matakuliah->nama_matakuliah ?? '-',
                    $krs->matakuliah->sks ?? '-',
                    $krs->created_at ? $krs->created_at->format('d/m/Y H:i') : '-'
                ];
            }
            
            $headers = ['NO', 'NPM', 'NAMA MAHASISWA', 'DOSEN WALI', 'KODE MK', 'NAMA MATA KULIAH', 'SKS', 'TANGGAL AMBIL'];
            
            return Excel::download(new class($data, $headers) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings {
                private $data;
                private $headers;
                
                public function __construct($data, $headers)
                {
                    $this->data = $data;
                    $this->headers = $headers;
                }
                
                public function array(): array
                {
                    return $this->data;
                }
                
                public function headings(): array
                {
                    return $this->headers;
                }
            }, 'laporan_krs_' . date('Ymd_His') . '.xlsx');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal export Excel: ' . $e->getMessage());
        }
    }
}