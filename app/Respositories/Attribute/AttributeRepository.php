<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute\Attribute;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Attribute\AttributeOptionRepository;
use Illuminate\Container\Container as App;

class AttributeRepository extends Repository
{
    /**
     * Create a new repository instance.
     *
     * @param  \App\Repositories\Attribute\AttributeOptionRepository  $attributeOptionRepository
     * @return void
     */
    public function __construct(
        AttributeOptionRepository $attributeOptionRepository,
        App $app
    ) {
        $this->attributeOptionRepository = $attributeOptionRepository;

        parent::__construct($app);
    }
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Attribute::class;
    }
}
