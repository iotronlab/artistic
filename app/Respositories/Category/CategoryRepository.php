<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use App\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Category::class;
    }
    /**
     * Specify category tree
     */
    public function getCategoryTree($id = null)
    {
        return $id
            ? $this->model::orderBy('created_at', 'ASC')->where('id', '!=', $id)->get()->toTree()
            : $this->model::orderBy('created_at', 'ASC')->get();
    }
}
