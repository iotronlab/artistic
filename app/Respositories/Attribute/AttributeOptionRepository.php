<?php

namespace App\Repositories\Attribute;

use App\Repositories\Eloquent\Repository;
use App\Models\Attribute\AttributeOption as AttributeOption;

class AttributeOptionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return AttributeOption::class;
    }
}
