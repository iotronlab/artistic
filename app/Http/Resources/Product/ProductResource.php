<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Vendor\VendorReviewResource;
use App\Models\Attribute\AttributeOption;

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
            'comments'  => ProductCommentResource::collection($this->comments),
            'attributes' => [
                'color'    => $this->flat->color ? $product->option($this->flat->color) : null,
                'size'     => $this->flat->size ? $product->option($this->flat->size) : null,
                'material' => $this->flat->material ? $product->option($this->flat->material) : null,
                'medium'   => $this->flat->medium ? $product->option($this->flat->medium) : null,
            ],
            'stock'                  => $product->stockCount(),
            'images'                 => ProductImageResource::collection($product->images),
            'reviews'                => VendorReviewResource::collection($product->vendor->reviews),
            //merge variants for configurable product
            $this->mergeWhen($product->getTypeInstance()->isComposite(), [
                'variants'           => Self::collection($this->variants),
            ]),
            //merge for bundle product
            $this->mergeWhen($product->getTypeInstance()->isBundle(), [
                'bundle_products'           => Self::collection($this->bundle_products),
            ]),
        ]);
    }
}
