<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
class BkppService
{
    public $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        $cuti = $this->model->find($id);
        return $cuti;
    }
    public function update($model, $data)
    {
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->model->query();
    }
}
