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
            'name', 'contact', 'address_1', 'address_2', 'city', 'postal_code', 'default', 'state', 'country_id'
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
        $new_address = Address::find($id);
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
        $address = Address::find($address_id);
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
