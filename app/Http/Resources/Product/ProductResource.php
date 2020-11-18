<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Vendor\VendorReviewResource;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->product ? $this->product : $this->flat;


        return array_merge(parent::toArray($request), [
            'short_description'      => $this->flat->short_description,
            'attributes' => [
                'color'                  => $this->flat->color,
                'size'                   => $this->flat->size,
                'material'                  => $this->flat->material,
                'medium'                   => $this->flat->medium,
            ],

            'stock'                  => $product->stockCount(),
            'images'                 => ProductImageResource::collection($product->images),
            'reviews'                => VendorReviewResource::collection($product->vendor->reviews),
            //merge variants for configurable product
            $this->mergeWhen($product->getTypeInstance()->isComposite(), [
                'variants'               => Self::collection($this->variants),
            ])
        ]);
    }
}
