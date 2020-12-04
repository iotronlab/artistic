<?php

namespace App\Repositories\CatalogRule;

use App\Models\CatalogRule\CatalogRule;
use App\Repositories\Eloquent\Repository;

class CatalogRuleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CatalogRule::class;
    }
    /**
     * @param  array  $data
     * @return \CatalogRule\Contracts\CatalogRule
     */
    public function create(array $data)
    {
        $data['starts_from'] = $data['starts_from'] ?: null;

        $data['ends_till'] = $data['ends_till'] ?: null;

        $data['status'] = !isset($data['status']) ? 0 : 1;

        $catalogRule = parent::create($data);

        $catalogRule->customer_groups()->sync($data['customer_groups']);

        return $catalogRule;
    }
}
