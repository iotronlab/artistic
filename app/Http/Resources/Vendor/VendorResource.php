<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;
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

            'products' =>
            ProductIndexResource::collection(
                $this->products
            ),

            'reviews' =>
            VendorReviewResource::collection(
                $this->reviews
            ),

        ]);
    }
}
