<?php

namespace App\Repositories\Attribute;

use App\Repositories\Eloquent\Repository;

class AttributeGroupRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Attribute\AttributeGroup';
    }
}
