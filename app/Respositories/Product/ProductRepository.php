<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Eloquent\Repository;
use App\Scoping\Scopes\AttributeScope;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;

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

    public function getAll()
    {
        $params = request()->input();
        $results = Product::with('variants', 'flat')
            ->withScopes($this->scopes())->newest()
            ->paginate(isset($params['limit']) ? $params['limit'] : 20);
        return $results;
    }
    protected function scopes()
    {
        return [

            //'attribute' => new AttributeScope(),
            'category' => new CategoryScope()
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

    public function upload(array $data, $product)
    {
        $index = 1;
        $vendorId = 1;
        $images = request()->file('product');

        if (request()->hasFile('product')) {
            foreach ($images as $item) {
                $extension = $item->getClientOriginalExtension();
                //Filename to store
                $pic_path = $product->sku . '-' . $index . '.' . $extension;
                //Upload Image
                $path = $item->storeAs('/' . $vendorId . '/' . $product->sku, $pic_path);
                ProductImage::create([
                    'alt' => $product->sku,
                    'path' => $path,
                    'product_id' => $product->id
                ]);
                $index = $index + 1;
            }
        }
        return 'Image uploaded successfully';
    }
}
