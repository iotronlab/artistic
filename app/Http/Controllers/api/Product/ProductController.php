<?php

namespace App\Http\Controllers\api\Product;

use App\Helpers\ProductType;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductAttributeResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Attribute\Attribute;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductBundle;
use App\Models\Product\ProductFlat;
use App\Models\Product\ProductImage;
use App\Models\Product\Stock;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Throwable;

class ProductController extends Controller
{
    protected $productRepository;
    protected $attributeFamilyRepository;

    public function __construct(ProductRepository $productRepository,  AttributeFamilyRepository $attributeFamilyRepository)
    {
        $this->middleware('auth:vendor-api')->except(['index', 'show']);
        $this->productRepository = $productRepository;
        $this->attributeFamilyRepository = $attributeFamilyRepository;
    }
    /**
     * Returns a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return $products;
    }

    /**
     * get configurable family attributes along with options for new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $configurableFamily = null;
        // if ($familyId = request()->get('family')) { //for configurable type
        //     $configurableFamily = AttributeResource::collection(Attribute::where('is_configurable', 1)->get());
        // }
        // return $configurableFamily;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            !request()->get('family')
            && ProductType::hasVariants(request()->input('type'), $this->productRepository)
            && request()->input('sku') != ''
        ) {
            //For Configurable
            return redirect(url()->current() . '?type=' . request()->input('type') . '&family=' . request()->input('attribute_family_id') . '&sku=' . request()->input('sku'));
        }
        //configurable and invalid
        if (
            ProductType::hasVariants(request()->input('type'), $this->productRepository)
            && (!request()->has('super_attributes')
                || !count(request()->get('super_attributes')))
        ) {
            return response()->json([

                'failure' => 'Invalid configurable parameters',

            ], 404);
        }
        $this->validate(request(), [
            'type'                => 'required',
            'attribute_family_id' => 'required',
            'sku'                 => ['required', 'unique:products,sku']
        ]);
        $product = $this->productRepository->create(request()->all());
        return new ProductIndexResource(Product::find($product->id));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if ($product->parent) {
            $config = $this->configurableConfig($product->parent->id);
        } else {
            $config = $this->configurableConfig($product->id);
        }
        $product->increment('view_count', 1);
        if ($product->type == 'simple') {

            $categories = $product->categories;
            foreach ($categories as $key => $category) {
                $parent = $categories->where('parent_id', $category->id);
                if ($parent->isNotEmpty()) {
                    $categories->forget($key);
                }
            }


            return response()->json([
                'product' => (new ProductResource($product)),
                'categories' => CategoryIndexResource::collection($categories),
                'attributes' => ProductAttributeResource::collection($product->attribute_values),
            ], 200);
        } else {
            return response()->json(
                [
                    'configurable_attributes' => $config,
                    'product' => (new ProductResource($product))
                ],
                200
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //check if product belongs to vendor or not
        if ($request->user()->id != $product->vendor_id) {
            return response()->json([
                'failure' => 'Vendor can only edit his/her own products'
            ], 400);
        }
        $this->productRepository->update(request()->all(), $product->id);
        return response()->json([
            'Updated Successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            ProductFlat::where('product_id', $product->id)->delete();
            ProductAttributeValue::where('product_id', $product->id)->delete();

            $products = Product::where('parent_id', $product->id)->get();

            //For bundle
            if ($product->type == "bundle") {
                $bundle_products = ProductBundle::where('product_bundle_id', $product->id)->delete();
            }
            //Delete children if parent is deleted
            if ($products != null) {
                foreach ($products as $p) {
                    Product::find($p->id)->delete();
                    ProductFlat::where('product_id', $p->id)->delete();
                }
            }
            //Deleting image if exist
            $images = ProductImage::where('product_id', $product->id)->get();
            foreach ($images as $image) {
                $this->delete_image($image->id);
            }

            $this->productRepository->delete($product->id);
            return response()->json(['message' => "Deleted Successfully"], 200);
        } catch (\Exception $e) {
            report($e);
        }

        return response()->json(['message' => 'Error, cannot delete'], 400);
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return app('App\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id));
    }

    //Image upload
    public function upload(Request $request, Product $product)
    {
        $request->validate([
            'product.*' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);
        return response()->json(
            $this->productRepository->upload(request()->all(), $product)
        );
    }
    //Delete image
    public function delete_image($id)
    {
        $image = ProductImage::find($id);
        Storage::delete($image->path);
        //Delete
        $image->delete();
        return response()->json([
            'Image deleted successfully'
        ], 200);
    }

    //To get featured products
    public function featured()
    {
        $featured_products = DB::table('featured_products')->where('is_active', '1')->pluck('product_id');
        return ProductIndexResource::collection(Product::whereIn('id', $featured_products)->get());
    }

    //To add stock
    public function addStock(Product $product, Request $request)
    {
        try {
            $product = $this->productRepository->findOrFail($product->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Failure' => 'Product does not exist'], 404);
        }
        $prod_stock = Stock::create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
        ]);
        return response()->json([
            'Stock added successfully'
        ], 200);
    }

    //To assign category to product
    //issue: validation from front end, database has unique column combination validation
    public function addCategory(Product $product, Request $request)
    {

        try {
            $category_id = $request->category_id;
            $vendor = $request->user();

            $vendor->categories()->attach([
                $category_id
            ]);
            $parent_category = Category::find($category_id)->parent;
            //Attach parents if exist
            if ($parent_category != null) {
                $product->categories()->attach([
                    $parent_category->id
                ]);
                if ($parent_category->parent != null) {
                    $product->categories()->attach([
                        $parent_category->parent->id
                    ]);
                }
            }
            $product->categories()->attach([
                $category_id
            ]);
            return response()->json([
                'message' => 'Category assigned to product successfully'
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error assigning categories. Contact admin.'
            ], 400);
        }
    }

    public function removeCategory(Product $product, Request $request)
    {

        try {
            $category_id = $request->category_id;
            $vendor = $request->user();

            $vendor->categories()->detach([
                $category_id
            ]);
            $parent_category = Category::find($category_id)->parent;
            //Attach parents if exist
            if ($parent_category != null) {
                $product->categories()->detach([
                    $parent_category->id
                ]);
                if ($parent_category->parent != null) {
                    $product->categories()->detach([
                        $parent_category->parent->id
                    ]);
                }
            }
            $product->categories()->detach([
                $category_id
            ]);
            return response()->json([
                'message' => 'Category remove from product successfully'
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error removing categories. Contact admin.'
            ], 400);
        }
    }
}
