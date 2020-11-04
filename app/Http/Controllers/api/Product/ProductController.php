<?php

namespace App\Http\Controllers\api\Product;

use App\Helpers\ProductType;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Attribute\Attribute;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductBundle;
use App\Models\Product\ProductFlat;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Product\ProductFlatRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productFlatRepository;
    protected $attributeFamilyRepository;

    public function __construct(ProductRepository $productRepository, ProductFlatRepository $productFlatRepository, AttributeFamilyRepository $attributeFamilyRepository)
    {
        $this->productRepository = $productRepository;
        $this->productFlatRepository = $productFlatRepository;
        $this->attributeFamilyRepository = $attributeFamilyRepository;
    }
    /**
     * Returns a listing of the resource.
     */
    public function index()
    {
        // return response()->json([
        //     'data' => $this->productRepository->getAll()
        // ]);
        return ProductResource::collection($this->productRepository->getAll(request()->input('category_id')))
            ->additional([
                'max_price' => $this->productFlatRepository->getCategoryProductMaximumPrice(Category::find(request()->input('category_id'))),
                'filterable_attributes' => $this->productFlatRepository->getFilterableAttributes(Category::find(request()->input('category_id')))
            ]);
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
        return new ProductResource(Product::find($product->id)->flat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findOrFail($id);
        return response()->json([
            'configurable_attributes' => $this->configurableConfig($id),
            'product' => (new ProductResource($product->flat))
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findOrFail($id);
        return new ProductResource($product->flat);
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
    public function destroy($id)
    {
        $product = $this->productRepository->findOrFail($id);
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
            $this->productRepository->delete($id);
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
}
