<?php

namespace App\Http\Controllers\api\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Shipping;

class ShippingController extends Controller
{

    public function index(Shipping $shipping)
    {
        return response()->json(['token' => $shipping->token], 200);
    }
}
