<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [

            // 'category' => CategoryIndexResource::Collection(
            //     $this->with('children, children.children')
            // ),
            'products' => ProductIndexResource::Collection(
                $this->groupBy('vendor.display_name')
            ),
            // 'artists'  => VendorIndexResource::collection($this->products->sortByDesc('vendor.popularity'))
        ];
    }
}
