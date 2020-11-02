<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductFlat;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Eloquent\Repository;
use App\Scoping\Scopes\AttributeScope;
use Illuminate\Container\Container as App;


class ProductRepository extends Repository
{
    /**
     * AttributeRepository object
     *
     * @var \App\Repositories\Attribute\AttributeRepository
     */
    public $attributeRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Repositories\Attribute\AttributeRepository  $attributeRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */

    public function __construct(
        AttributeRepository $attributeRepository,
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
        return Product::class;
    }

    public function getAll($categoryId = null)
    {
        $params = request()->input();

        $results = ProductFlat::leftJoin('products', 'product_flat.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')
            ->withScopes($this->scopes())->paginate(isset($params['limit']) ? $params['limit'] : 9);
        return $results;
    }
    protected function scopes()
    {
        return [

            'attribute' => new AttributeScope()

        ];
    }

    /**
     * @param  array  $data
     * @return \App\Contracts\Product\Product
     */
    public function create(array $data)
    {
        $typeInstance = app(config('product_types.' . $data['type'] . '.class'));
        $product = $typeInstance->create($data);
        return $product;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \App\Contracts\Product\Product
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $product = Product::find($id);
        $this->typeInstance = app(config('product_types.' . $product['type'] . '.class'));
        $product = $this->typeInstance->update($data, $id, $attribute);
        return $product;
    }
}
