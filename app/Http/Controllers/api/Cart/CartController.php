<?php

namespace App\Http\Controllers\api\Cart;

use App\Helpers\Cart;
use App\Helpers\Money;
use App\Helpers\Shipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartShippingRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:cust-api']);
    }

    public function index(Request $request, Cart $cart)
    {

        //dd($request->user('cust-api'));
        $cartProducts = $request->user('cust-api')->load(
            'cart.vendor',
            'cart.flat',
            'cart.images',
            'cart.stock_addresses',
            'cart.ordered_stocks'
        );
        $cart->sync();
        // return ($cartProducts);
        return (new CartResource($cartProducts))
            ->additional([
                'meta' => $this->meta($cart, $request)
            ]);
    }

    protected function meta(Cart $cart, Request $request)
    {
        return [
            'empty' => $cart->IsEmpty(),
            'subtotal' => $cart->subtotal()->formatted(),
            //'tax' => $cart->applyTax()->formatted(),
            // 'discount' => $cart->ApplyCoupon($request->coupon_code)->formatted(),
            //  'total' => $cart->withShipping($request->shipping_method_id)->total($request->coupon_code)->formatted(),
            'changed' => $cart->hasChanged(),
        ];
    }
    protected function getShipping(Shipping $shipping, Request $request)
    {
        // $shipping->checkService($request->address_id);
    }


    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->products);
        $cart->sync();
        return response()->json(['message' => 'Added to cart successfully.'], 200);
    }

    public function update(Product $product, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($product->id, $request->quantity);
        $cart->sync();
        return response()->json(['message' => 'Product updated in cart.'], 200);
    }

    public function destroy(Product  $product,  Cart $cart)
    {
        $cart->delete($product->id);
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }

    public function setShipping(CartShippingRequest $request, Cart $cart)
    {
        $cart->setShipping($request->products);
        $cart->sync();
        return response()->json(['message' => 'Product shipping updated in cart.'], 200);
    }
}
