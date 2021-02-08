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
            'name',
            'address_1',
            'address_2',
            'landmark',
            'type',
            'contact',
            'city',
            'state',
            'country_code',
            'postal_code',
            'default'
        ]));
        $request->user()->addresses()->save($address);
        return new AddressResource(
            $address
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new_address = VendorAddress::find($id);
        $new_address->fill($request->all())->save();
        return response()->json(['success' => 'Address updated Sucessfully'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($address_id)
    {
        $address = VendorAddress::find($address_id);
        if ($address == null) {
            return
                response()->json(['failure' => 'Address not found'], 400);
        }
        if ($address->default) {
            return
                response()->json(['failure' => 'Default address cannot be deleted'], 400);
        }
        $address->delete();
        return response()->json(['success' => 'Address deleted Sucessfully'], 400);
    }
}
