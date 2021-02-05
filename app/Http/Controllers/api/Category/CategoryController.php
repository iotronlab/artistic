<?php

namespace App\Http\Controllers\api\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Category\Category;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;
use App\Http\Resources\Vendor\VendorResource;
use App\Models\Product\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryIndexResource::collection(
            Category::with(
                'children',
                'children.children'
            )->parents()->get()
        );
        // ->additional(["shipping_token" => (string)App::make('App\Helpers\ShipRocket')->token]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //Sort by popularities and then top 3 rows are fetched\
        $category->load('children', 'children.children');


        // $products = $category->products->groupBy('vendor.display_name')
        //     ->sortByDesc(function ($products, $key) {
        //         return count($products);
        //     });
        // $products = Product::whereHas('categories', function($query) use($category){

        //                $query->where('name', $category->url);

        //  });
        $vendors = $category->vendors()->orderByDesc('view_count')->paginate();
        $vendors->load('products');
        //  $products = $vendors->products->orderByDesc('view_count')->paginate(10);
        //   dd($products->items());
        // $results = $products->getCollection()->groupBy('vendor_id');
        // $products->setCollection($results);
        // $products->getCollection()->transform(function ($value) {
        //     // Your code here
        //     dd($value);
        //     //$value->groupBy('vendor_id');
        //     return $value;
        // });
        // $results;
        //$results = ProductIndexResource::collection($products);
        // $products = $products->additional([
        //     'category' => new CategoryIndexResource($category),

        // ]);
        //incrememt view count
        $category->increment('view_count', 1);
        // return [

        //     'products' => ProductIndexResource::collection($products),
        //     //  'vendors' =>  VendorIndexResource::collection($vendors),
        //     'category' => new CategoryIndexResource($category),
        // ];
        return VendorResource::collection($vendors)->additional(['category' => new CategoryIndexResource($category)]);
        // return $vendors;
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
