<?php

namespace App\Repositories;

abstract class EloquentRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function paginate()
    {
        $limit  = request('limit') ?: 30;

        return $this->model->paginate($limit);
    }

}