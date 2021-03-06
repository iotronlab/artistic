<?php

namespace App\Http\Controllers\api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shipping\ShippingMethodResource;
use App\Models\Customer\Address;
use App\Models\Order\ShippingMethod;
use Illuminate\Http\Request;

class AddressShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:cust-api']);
    }

    public function getShipping(Address $address)
    {
        //address policy

        $this->authorize('show', $address);
        return ShippingMethodResource::collection($address->country->shippingMethods);
        //return $address->country->shippingMethods;
    }
}
