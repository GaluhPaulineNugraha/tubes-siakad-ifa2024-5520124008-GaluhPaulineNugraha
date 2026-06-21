<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 0;
    
    public function collection()
    {
        return Dosen::all();
    }
    
    public function headings(): array
    {
        return [
            'NO',
            'NIDN',
            'NAMA DOSEN',
        ];
    }
    
    public function map($dosen): array
    {
        $this->no++;
        return [
            $this->no,
            $dosen->nidn,
            $dosen->nama,
        ];
    }
}