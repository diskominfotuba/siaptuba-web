<?php

namespace App\Imports;

use App\Models\Lhkpn;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class LhkpnImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Lhkpn([
            'td_1'  => $row[0],
            'td_2'  => $row[1],
            'td_3'  => $row[2],
        ]);
    }
}
