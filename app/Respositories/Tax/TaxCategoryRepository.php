<?php

namespace App\Repositories\Tax;

use App\Models\Tax\TaxCategory;
use App\Repositories\Eloquent\Repository;

class TaxCategoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return TaxCategory::class;
    }
}
