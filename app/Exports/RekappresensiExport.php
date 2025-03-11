<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekappresensiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $users;
    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function map($users): array
    {
        return [
            $users->nama,
            $users->status_pegawai == 'asn' ? 'ASN' : 'Non ASN',
            $users->opd->nama_opd,
            $users->persensi_count,
        ];
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'STATUS PEGAWAI',
            'OPD',
            'TOTAL KEHADIRAN',
        ];
    }
}
