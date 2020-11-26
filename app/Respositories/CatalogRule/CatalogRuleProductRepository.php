<?php

namespace App\Repositories\CatalogRule;

use App\Models\CatalogRule\CatalogRuleProduct;
use App\Repositories\Eloquent\Repository;

class CatalogRuleProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CatalogRuleProduct::class;
    }
}
