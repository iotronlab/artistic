<?php

namespace App\Http\Controllers\api\CatalogRule;

use App\Helpers\CatalogRule\CatalogRuleIndex;
use App\Http\Controllers\Controller;
use App\Models\CatalogRule\CatalogRule;
use App\Models\CatalogRule\CatalogRuleProductPrice;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductFlat;
use App\Repositories\CatalogRule\CatalogRuleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CatalogRuleController extends Controller
{
    /**
     * To hold Catalog repository instance
     */
    protected $catalogRuleRepository;

    /**
     * CatalogRuleIndex
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        CatalogRuleRepository $catalogRuleRepository,
        CatalogRuleIndex $catalogRuleIndexHelper
    ) {

        $this->catalogRuleRepository = $catalogRuleRepository;

        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatalogRule::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'            => 'required',
            'customer_groups' => 'required|array|min:1',
            'action_type'     => 'required',
            'discount_amount' => 'required|numeric',
            'category_id'     => 'required'
        ]);

        $data = request()->all();
        $catalogRule = $this->catalogRuleRepository->create($data);
        // $this->catalogRuleIndexHelper->reindexComplete();

        $request->rule_id = $catalogRule->id;
        if ($request->product_id != null) {
            $this->addProduct($request);
        }

        $products = Category::find($request->category_id)->products;

        if ($products != null) {
            foreach ($products as $product) {
                $request->product_id = $product->id;
                $this->addProduct($request);
            }
        }

        return response()->json([
            $catalogRule
        ], 200);
    }

    public function addProduct(Request $request)
    {
        $price = Product::find($request->product_id)->flat->price->amount();
        if ($request->action_type == "by_fixed") {
            $discounted_price = $price - $request->discount_amount;
        } else {
            $discounted_price = ((100 - $request->discount_amount) * $price) / 100;
        }
        CatalogRuleProductPrice::create([
            'catalog_rule_id' => $request->rule_id,
            'product_id' => $request->product_id,
            'price' => $discounted_price,
            'created_at' => Carbon::now()
        ]);
        $special_price = $discounted_price > 0 ? $discounted_price : null;
        ProductFlat::where('product_id', $request->product_id)->update([
            'special_price' => $special_price
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
