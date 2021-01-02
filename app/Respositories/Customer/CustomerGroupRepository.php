<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerGroup;
use App\Repositories\Eloquent\Repository;

class CustomerGroupRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CustomerGroup::class;
    }
}
