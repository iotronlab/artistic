<?php

namespace App\Repositories\Product;

use App\Models\Product\ProductAttributeValue;
use App\Repositories\Attribute\AttributeRepository;
use Illuminate\Container\Container as App;
use App\Repositories\Eloquent\Repository;

class ProductAttributeValueRepository extends Repository
{
    /**
     * AttributeRepository object
     *
     * @var \App\Repositories\Attribute\AttributeRepository
     */
    protected $attributeRepository;

    /**
     * Create a new reposotory instance.
     *
     * @param  \App\Repositories\Attribute\AttributeRepository  $attributeRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository = null,
        App $app
    ) {
        $this->attributeRepository = $attributeRepository;
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return ProductAttributeValue::class;
    }
}
