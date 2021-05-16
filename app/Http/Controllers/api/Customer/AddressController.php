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
        $this->middleware(['auth:cust-api']);
    }

    public function index(Request $request)
    {
        return AddressResource::collection(

            $request->user()->addresses->sortByDesc('updated_at')
        );
    }

    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only([
            'name',
            'address_1',
            'address_2',
            'landmark',
            'type',
            'contact',
            'city',
            'state',
            'country_id',
            'postal_code',
            'country_code',
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
        $updateAddress = Address::find($id);
        $updateAddress->fill($request->only([
            'name',
            'address_1',
            'address_2',
            'landmark',
            'type',
            'contact',
            'city',
            'state',
            'country_id',
            'postal_code',
            'country_code',
            'default'
        ]))->save();
        return new AddressResource(
            $updateAddress
        );
        // return response()->json(['success' => 'Address updated Sucessfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($address_id)
    {
        $address = Address::find($address_id);
        if ($address == null) {
            return
                response()->json(['message' => 'Address not found'], 400);
        }
        if ($address->default) {
            return
                response()->json(['message' => 'Default address cannot be deleted'], 400);
        }
        $address->delete();
        return response()->json(['message' => 'Address deleted sucessfully.'], 200);
    }
}
