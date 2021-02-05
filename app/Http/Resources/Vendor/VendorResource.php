<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductIndexResource;
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

            // 'products' => ProductIndexResource::Collection(
            //     $this->products->groupBy('baseCategory')
            //         ->sortByDesc(function ($products, $key) {
            //             return count($products);
            //         })
            // ),
            'products' =>
            ProductIndexResource::collection(
                $this->products
            ),

            // 'categories' =>
            // CategoryIndexResource::collection(
            //     $this->categories
            // ),


            // 'reviews' =>
            // VendorReviewResource::collection(
            //     $this->reviews
            // ),

        ]);
    }
}
