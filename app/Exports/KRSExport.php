<?php

namespace App\Exports;

use App\Models\KRS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KRSExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $no = 0;
    
    public function collection()
    {
        return KRS::with(['mahasiswa.dosen', 'matakuliah'])->get();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'NPM',
            'NAMA MAHASISWA',
            'DOSEN WALI',
            'KODE MATA KULIAH',
            'NAMA MATA KULIAH',
            'SKS',
            'TANGGAL AMBIL'
        ];
    }
    
    public function map($krs): array
    {
        $this->no++;
        
        return [
            $this->no,
            $krs->mahasiswa->npm ?? '-',
            $krs->mahasiswa->nama ?? '-',
            $krs->mahasiswa->dosen->nama ?? '-',
            $krs->matakuliah->kode_matakuliah ?? '-',
            $krs->matakuliah->nama_matakuliah ?? '-',
            $krs->matakuliah->sks ?? '-',
            $krs->created_at ? $krs->created_at->format('d/m/Y H:i') : '-'
        ];
    }
}