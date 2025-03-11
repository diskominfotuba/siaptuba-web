<?php

namespace App\Services;

use App\Models\Kinerja;

class KinerjaService
{
    public $kinerja;
    public function __construct(Kinerja $kinerja)
    {
        $this->kinerja = $kinerja;
    }

    public function store($data)
    {
        return $this->kinerja->create($data);
    }

    public function find($id)
    {
        $model = $this->kinerja->find($id);
        if (!$model) {
            throw new \Exception("Data not found");
        }
        return $model;
    }
    
    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->kinerja->query();
    }
}
