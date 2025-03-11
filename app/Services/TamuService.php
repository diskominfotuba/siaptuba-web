<?php

namespace App\Services;

use App\Models\TamuUndangan;

class TamuService 
{
    public $tamu_undangan;
    public function __construct(TamuUndangan $tamu_undangan)
    {
        $this->tamu_undangan = $tamu_undangan;
    }

    public function store($data)
    {
        return $this->tamu_undangan->create($data);
    }

    public function find($id)
    {
        $tamu_undangan = $this->tamu_undangan->find($id);
        return $tamu_undangan;
    }
    public function update($id, $data)
    {
        $model = $this->tamu_undangan->find($id);
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->tamu_undangan->query();
    }
}