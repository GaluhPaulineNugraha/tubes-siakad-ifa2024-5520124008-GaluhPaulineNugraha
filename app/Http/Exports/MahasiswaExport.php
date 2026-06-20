<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;
    
    public function collection()
    {
        return Mahasiswa::with('dosen')->get();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'NPM',
            'NAMA MAHASISWA',
            'DOSEN WALI',
        ];
    }
    
    public function map($mahasiswa): array
    {
        $this->no++;
        return [
            $this->no,
            $mahasiswa->npm,
            $mahasiswa->nama,
            $mahasiswa->dosen->nama ?? '-',
        ];
    }
}