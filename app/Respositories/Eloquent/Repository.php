<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;

abstract class Repository extends BaseRepository
{
    /**
     * Find data by id
     *
     * @param  int  $id
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $model = $this->model->find($id, $columns);
        return $model;
    }
    /**
     * Find data by id
     *
     * @param  int  $id
     * @param  array  $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $model = $this->model->findOrFail($id, $columns);
        return $model;
    }
    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
}
