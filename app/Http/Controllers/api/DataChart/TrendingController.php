<?php

namespace App\Http\Controllers\api\DataChart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;
use App\Models\Product\Product;

class TrendingController extends Controller
{
    public function index(Request $request)
    {
        // $params = request()->input();

        // if (request()->input('category') != null) {

        //

        // }
        $categories = Category::select("*")->orderByDesc("view_count")->get();
        // $categories->trending()->get();
        $products = Product::select("*")->orderByDesc("view_count")->get();
        return [

            // 'products' => ProductIndexResource::collection($products),
            // 'artists' =>  VendorIndexResource::collection($artists),
            'categories' =>  CategoryIndexResource::collection($categories),
        ];
    }
}
