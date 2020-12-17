<?php

namespace App\Http\Controllers\api\Product;

use App\Helpers\ProductType;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Product\ProductAttributeResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Attribute\Attribute;
use App\Models\Product\Product;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductBundle;
use App\Models\Product\ProductFlat;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Product\ProductFlatRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $attributeFamilyRepository;

    public function __construct(ProductRepository $productRepository,  AttributeFamilyRepository $attributeFamilyRepository)
    {
        //$this->middleware(['auth:api'])->except(['index']);
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
        $configurableFamily = null;
        if ($familyId = request()->get('family')) { //for configurable type
            $configurableFamily = AttributeResource::collection(Attribute::where('is_configurable', 1)->get());
        }
        return $configurableFamily;
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
            'sku'                 => ['required', 'unique:products,sku'],
        ]);
        $product = $this->productRepository->create(request()->all());
        return new ProductResource(Product::find($product->id));
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
        if ($product->type == 'simple') {
            return response()->json([
                'product' => (new ProductResource($product)),
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
    public function update(Request $request, $id)
    {
        $this->productRepository->update(request()->all(), $id);
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

    public function upload(Product $product)
    {
        return response()->json(
            $this->productRepository->upload(request()->all(), $product)
        );
    }
    //To get featured products
    public function featured()
    {
        $featured_products = DB::table('featured_products')->where('is_active', '1')->pluck('product_id');
        return ProductIndexResource::collection(Product::whereIn('id', $featured_products)->get());
    }
}
