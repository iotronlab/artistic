<?php

namespace App\Http\Controllers\api\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ShipRocket;

class ShippingController extends Controller
{

    public function index(ShipRocket $shiprocket)
    {
        return response()->json(['token' => $shiprocket->token], 200);
    }
}
