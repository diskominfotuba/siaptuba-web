<?php

namespace App\Services;

use App\Models\Kegiatan;

class KegiatanService
{
    public $kegiatan;
    public function __construct(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function store($data)
    {
        return $this->kegiatan->create($data);
    }

    public function find($id)
    {
        $kegiatan = $this->kegiatan->find($id);
        return $kegiatan;
    }
    public function update($id, $data)
    {
        $model = $this->kegiatan->find($id);
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->kegiatan->query();
    }
}
