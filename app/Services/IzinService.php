<?php

namespace App\Services;

use App\Models\Izin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Tpp;

class IzinService
{
    public $izin;
    public function __construct(Izin $izin)
    {
        $this->izin = $izin;
    }

    public function store($data)
    {
        return $this->izin->create($data);
    }

    public function find($id)
    {
        $cuti = $this->izin->find($id);
        return $cuti;
    }
    public function update($id, $data)
    {
        $model = $this->izin->find($id);
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->izin->query();
    }
}
