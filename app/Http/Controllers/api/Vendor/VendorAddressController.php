<?php

namespace App\Http\Controllers\api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressStoreRequest;
use App\Http\Resources\Address\AddressResource;
use App\Models\Vendor\VendorAddress;
use Illuminate\Http\Request;

class VendorAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:vendor-api']);
    }

    public function index(Request $request)
    {
        return AddressResource::collection(

            $request->user()->addresses
        );
    }

    public function store(AddressStoreRequest $request)
    {
        $address = VendorAddress::make($request->only([
            'name', 'address_1', 'city', 'postal_code', 'default'
        ]));
        $request->user()->addresses()->save($address);
        return new AddressResource(
            $address
        );
    }
}
