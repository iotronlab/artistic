<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\AddressResource;
use App\Models\Customer\Customer;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function subscribeVendor(Request $request, Vendor $vendor)
    {
        $request->user('api')->subscriptions()->attach([
            $vendor->id
        ]);
        return response()->json(['success' => 'Customer subscribed successfully'], 400);
    }

    public function unsubscribeVendor(Request $request, Vendor $vendor)
    {
        $request->user('api')->subscriptions()->detach([
            $vendor->id
        ]);
        return
            response()->json(['success' => 'Customer Unsubscribed successfully'], 400);
    }


    public function getAddresses(Request $request)
    {
        return AddressResource::collection(

            $request->user()->addresses
        );
    }

    public function getWishlist(Request $request)
    {
        return AddressResource::collection(

            $request->user()->wishlist
        );
    }

    public function getOrders(Request $request)
    {
        return AddressResource::collection(

            $request->user()->orders
        );
    }
}
