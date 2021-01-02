<?php

namespace App\Repositories\CartRule;

use App\Models\CartRule\CartRule;
use Illuminate\Container\Container as App;
use App\Repositories\Eloquent\Repository;

class CartRuleRepository extends Repository
{
    public function __construct(
        App $app
    ) {
        parent::__construct($app);
    }
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CartRule::class;
    }
    /**
     * @param  array  $data
     * @return \CatalogRule\Contracts\CatalogRule
     */
    public function create(array $data)
    {
        $data['status'] = !isset($data['status']) ? 0 : 1;

        $catalogRule = parent::create($data);
        $catalogRule->customer_groups()->sync($data['customer_groups']);

        return $catalogRule;
    }
}
