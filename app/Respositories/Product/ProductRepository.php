<?php

namespace App\Repositories\Product;

use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Eloquent\Repository;
use App\Scoping\Scopes\AttributeScope;
use App\Scoping\Scopes\CategoryScope;
use App\Scoping\Scopes\ColorScope;
use App\Scoping\Scopes\FeaturedScope;
use App\Scoping\Scopes\MaterialScope;
use App\Scoping\Scopes\MediumScope;
use App\Scoping\Scopes\NewScope;
use App\Scoping\Scopes\PriceScope;
use App\Scoping\Scopes\SizeScope;
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
    protected $productFlatRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Repositories\Attribute\AttributeRepository  $attributeRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */

    public function __construct(
        AttributeRepository $attributeRepository,
        ProductFlatRepository $productFlatRepository,
        App $app
    ) {
        $this->attributeRepository = $attributeRepository;

        $this->productFlatRepository = $productFlatRepository;

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
        $results = Product::with('variants', 'flat', 'vendor', 'images', 'ordered_inventories', 'inventories')
            ->withScopes($this->scopes())
            ->paginate(isset($params['limit']) ? $params['limit'] : 20);

        $products = ProductIndexResource::collection($results);

        if (request()->input('category') != null) {
            $arr = explode(',', request()->input('category'));
            $products = $products->additional([
                'max_price' => $this->productFlatRepository->getCategoryProductMaximumPrice($arr[0]),
                'filterable_attributes' => $this->productFlatRepository->getFilterableAttributes($arr[0])
            ]);
        }
        return $products;
    }
    protected function scopes()
    {
        return [
            'price' => new PriceScope(),
            'new' => new NewScope(),
            'featured' => new FeaturedScope(),
            'color' => new ColorScope(),
            'size' => new SizeScope(),
            'material' => new MaterialScope(),
            'medium' => new MediumScope(),
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
        $vendorId = $product->vendor_id;
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
