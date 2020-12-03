<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends CategoryIndexResource
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

            'products' => ProductIndexResource::Collection(
                $this->products->groupBy('vendor.display_name')
                ->sortByDesc(function ($products, $key) {
                    return count($products);
                })
            ),
            // 'artists'  => VendorIndexResource::collection($this->products->sortByDesc('vendor.popularity'))
        ]);
    }
}
