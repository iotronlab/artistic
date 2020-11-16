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
    public function create(array $data)
    {
        if (isset($data['attribute_id'])) {
            $attribute = $this->attributeRepository->find($data['attribute_id']);
        } else {
            $attribute = $this->attributeRepository->findOneByField('code', $data['attribute_code']);
        }

        if (!$attribute) {
            return;
        }

        $data[ProductAttributeValue::$attributeTypeFields[$attribute->type]] = $data['value'];

        return $this->model->create($data);
    }
}
