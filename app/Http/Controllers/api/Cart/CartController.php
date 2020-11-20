<?php

namespace App\Http\Controllers\api\Cart;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request, Cart $cart)
    {
        $cart->sync();
        //dd($request->user('api'));
        $request->user('api')->load(['cart', 'cart.stock']);
        return (new CartResource($request->user('api')))
            ->additional([
                'meta' => $this->meta($cart, $request)
            ]);
    }

    protected function meta(Cart $cart, Request $request)
    {
        return [
            'empty' => $cart->IsEmpty(),
            'subtotal' => $cart->subtotal()->formatted(),
            //'total' => $cart->withShipping($request->shipping_method_id)->total()->formatted(),
            'changed' => $cart->hasChanged(),
        ];
    }

    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->products);
        $cart->sync();
        return response()->json(['success' => 'Products stored in cart successfully'], 400);
    }

    public function update(Product $product, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($product->id, $request->quantity);
        return response()->json(['success' => 'Product updated in cart'], 400);
    }

    public function destroy(Product  $product,  Cart $cart)
    {
        $cart->delete($product->id);
        return response()->json(['success' => 'Product deleted successfully'], 400);
    }
}
