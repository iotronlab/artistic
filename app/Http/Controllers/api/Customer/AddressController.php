<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressStoreRequest;
use App\Http\Resources\Address\AddressResource;
use App\Models\Customer\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request)
    {
        return AddressResource::collection(

            $request->user()->addresses
        );
    }

    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only([
            'name', 'address_1', 'city', 'postal_code', 'default'
        ]));
        $request->user()->addresses()->save($address);
        return new AddressResource(
            $address
        );
    }
}
