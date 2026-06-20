<?php

namespace App\Exports;

use App\Models\KRS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;
    
    public function collection()
    {
        return KRS::with(['mahasiswa', 'matakuliah'])->get();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'NPM',
            'NAMA MAHASISWA',
            'MATA KULIAH',
            'SKS',
            'NILAI',
            'GRADE',
            'STATUS',
        ];
    }
    
    public function map($krs): array
    {
        $this->no++;
        
        $nilai = $krs->nilai ?? '-';
        $grade = $krs->grade ?? '-';
        $status = $krs->status ?? '-';
        
        return [
            $this->no,
            $krs->mahasiswa->npm ?? '-',
            $krs->mahasiswa->nama ?? '-',
            $krs->matakuliah->nama_matakuliah ?? '-',
            $krs->matakuliah->sks ?? '-',
            $nilai,
            $grade,
            $status,
        ];
    }
}