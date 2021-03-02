<?php

namespace App\Http\Controllers\api\DataChart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;
use App\Models\Product\Product;
use App\Models\Vendor\Vendor;

class TrendingController extends Controller
{
    public function index(Request $request)
    {
        // $params = request()->input();

        // if (request()->input('category') != null) {

        //

        // }
        //should be category where status is true
        $categories = Category::with('children')->orderByDesc("view_count")->get();
        //Category::doesntHave increases sql
        $filter = $categories->filter(function ($category) {
            if ($category->children->isEmpty()) {
                return $category;
            }
            // $category->children->whenEmpty(function ($category) {
            //     return $category;
            // });
        })->take(4);


        //  $filter = $categories->whereNull('children');
        $products = Product::with('images')->orderByDesc("view_count")->take(10)->get();
        $vendors = Vendor::select("*")->orderByDesc("view_count")->take(4)->get();
        return [

            'products' => ProductIndexResource::collection($products),
            'vendors' =>  VendorIndexResource::collection($vendors),
            'categories' =>  CategoryIndexResource::collection($filter),
        ];
    }
}
