<?php

namespace App\Repositories\Product;

use App\Helpers\Money;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Vendor\Vendor;
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
use App\Scoping\Scopes\StockScope;
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
        $results = Product::with('variants', 'categories', 'flat', 'vendor', 'images', 'ordered_stocks', 'stocks', 'stocks.address')
            ->withScopes($this->scopes())
            ->paginate(isset($params['limit']) ? $params['limit'] : 20);


        $products = ProductIndexResource::collection($results);

        if (request()->input('category') != null) {
            $arr = explode(',', request()->input('category'));
            $category = Category::where('url', $arr[0])->first();
            $products = $products->additional([
                'category_children' => CategoryIndexResource::collection($category->children),
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
            'category' => new CategoryScope(),
            // 'stock' => new StockScope()
        ];
    }

    /**
     * @return \App\Contracts\Product\Product
     */
    public function create(array $data)
    {
        $data['vendor_id'] = request()->user()->id;
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

    //Function to upload image
    public function upload(array $data, $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();
        if ($images == null) {
            $index = 1;
        } else {
            $index = count($images) + 1;
        }

        $vendor = Vendor::find($product->vendor_id)->url;
        $images = request()->file('product');

        if (request()->hasFile('product')) {
            foreach ($images as $item) {
                $extension = $item->getClientOriginalExtension();
                //Filename to store
                $pic_path = $product->sku . '-' . $index . '.' . $extension;
                //Upload Image
                $path = $item->storeAs('/product-images/' . $vendor . '/' . $product->sku, $pic_path, 'public');
                $url = Storage::url($path);
                $web_url = asset($url);
                ProductImage::create([
                    'alt' => $product->sku,
                    'path' => $path,
                    'url' => $web_url,
                    'product_id' => $product->id
                ]);
                $index = $index + 1;
            }
        }
        return response()->json([
            'message' => 'uploaded successfully. :)'
        ], 200);
    }
}
