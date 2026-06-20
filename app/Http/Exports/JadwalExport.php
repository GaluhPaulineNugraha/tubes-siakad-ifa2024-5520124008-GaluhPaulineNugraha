<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JadwalExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;
    
    public function collection()
    {
        return Jadwal::with(['matakuliah', 'dosen'])->get();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'MATA KULIAH',
            'DOSEN',
            'HARI',
            'JAM',
            'KELAS',
        ];
    }
    
    public function map($jadwal): array
    {
        $this->no++;
        return [
            $this->no,
            $jadwal->matakuliah->nama_matakuliah ?? '-',
            $jadwal->dosen->nama ?? '-',
            $jadwal->hari,
            date('H:i', strtotime($jadwal->jam)) . ' WIB',
            $jadwal->kelas,
        ];
    }
}