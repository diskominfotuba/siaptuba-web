<?php

namespace App\Services;

use App\Models\Dokumen;
class DokumenService
{
    public $dokumen;
    public function __construct(Dokumen $dokumen)
    {
        $this->dokumen = $dokumen;
    }

    public function store($data)
    {
        return $this->dokumen->create($data);
    }

    public function find($id)
    {
        $cuti = $this->dokumen->find($id);
        return $cuti;
    }
    public function update($id, $data)
    {
        $model = $this->dokumen->where('user_id', $id)->first();
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->dokumen->query();
    }
}
