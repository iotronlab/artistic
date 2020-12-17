<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    public function index(Request $request)
    {
        return ProductIndexResource::collection(

            $request->user()->wishlist
        );
    }
    public function store(Request $request)
    {
        $request->user('api')->wishlist()->attach([
            $request->product_id
        ]);
        return response()->json(['success' => 'Product added to whishlist successfully'], 400);
    }

    public function destroy(Product $product)
    {
        Auth::user()->wishlist()->detach([
            $product->id
        ]);
        return
            response()->json(['success' => 'Product deleted from whishlist successfully'], 400);
    }
}
