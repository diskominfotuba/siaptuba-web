<?php

namespace App\Services;

use App\Models\SurveyMedia;

class SurveyMediaService
{
    public $surveyMedia;
    public function __construct(SurveyMedia $surveyMedia)
    {
        $this->surveyMedia = $surveyMedia;
    }

    public function store($data)
    {
        return $this->surveyMedia->create($data);
    }

    public function find($id)
    {
        $model = $this->surveyMedia->find($id);
        if (!$model) {
            throw new \Exception("Data not found");
        }
        return $model;
    }

    public function Query()
    {
        return $this->surveyMedia->query();
    }
}
