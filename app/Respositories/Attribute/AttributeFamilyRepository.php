<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute\AttributeFamily;
use App\Repositories\Eloquent\Repository;

class AttributeFamilyRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return AttributeFamily::class;
    }
}
