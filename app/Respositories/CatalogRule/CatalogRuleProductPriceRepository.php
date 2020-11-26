<?php

namespace App\Repositories\CatalogRule;

use App\Models\CatalogRule\CatalogRuleProductPrice;
use App\Repositories\Eloquent\Repository;

class CatalogRuleProductPriceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CatalogRuleProductPrice::class;
    }
}
