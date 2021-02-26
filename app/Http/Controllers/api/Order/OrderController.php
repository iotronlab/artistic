<?php

namespace App\Http\Controllers\api\Order;

use App\Events\Order\OrderPlaced;
use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Customer\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
        $this->middleware(['cart.sync'])->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = request()->user()->orders()->latest()->paginate(10);
        return OrderResource::Collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request, Cart $cart)
    {
        if ($cart->isEmpty()) {
            return response()->json(['message' => 'cart is empty.'], 400);
        }
        $order = $this->createOrder($request, $cart);
        $order->products()->sync($cart->products()->forSyncing());
        // $order->load('products');
        event(new OrderPlaced($order));
        return new OrderResource($order);
    }
    protected function createOrder(Request $request, Cart $cart)
    {
        return $request->user()->orders()->create(
            array_merge(
                $request->only(['address_id', 'shipping_method_id']),
                ['subtotal' => $cart->subtotal()->amount()]
            )
        );
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
