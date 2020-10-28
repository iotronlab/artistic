<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\Vendor\VendorIndexResource;

class VendorResource extends VendorIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [

            'products' => 'product data'
            // Product::collection(
            //     $this->products
            // ),

        ]);
    }
}
