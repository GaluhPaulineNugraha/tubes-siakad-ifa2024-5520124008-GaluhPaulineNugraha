<?php

namespace App\Exports;

use App\Models\Matakuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MatakuliahExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;
    
    public function collection()
    {
        return Matakuliah::all();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'KODE MK',
            'NAMA MATA KULIAH',
            'SKS',
        ];
    }
    
    public function map($matakuliah): array
    {
        $this->no++;
        return [
            $this->no,
            $matakuliah->kode_matakuliah,
            $matakuliah->nama_matakuliah,
            $matakuliah->sks,
        ];
    }
}