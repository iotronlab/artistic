<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Vendor\VendorReviewResource;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function __construct($resource)
    {
        $this->productHelper = app('App\Helpers\ProductHelper');
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        $product = $this->product ? $this->product : $this->flat;

        return array_merge(parent::toArray($request), [
            'base_category' =>   $this->productHelper->getProductBaseCategory($this->whenLoaded('categories')),
            'short_description'      => $this->flat->short_description,
            'description'      => $this->flat->description,
            'meta_title'      => $this->flat->meta_title,
            'meta_keyword'      => $this->flat->meta_keyword,
            'meta_description'      => $this->flat->meta_description,

            'comments'  => ProductCommentResource::collection($this->comments),
            'family_id' => $this->attribute_family_id,
            'attributes' => [
                'color'    => $this->flat->color ? $product->option($this->flat->color) : null,
                'size'     => $this->flat->size ? $product->option($this->flat->size) : null,
                'material' => $this->flat->material ? $product->option($this->flat->material) : null,
                'medium'   => $this->flat->medium ? $product->option($this->flat->medium) : null,
                'orientation'   => $this->flat->orientation ? $product->option($this->flat->orientation) : null,
            ],
            'stock'                  => $product->stockCount(),
            'images'                 => ProductImageResource::collection($product->images),
            'reviews'                => VendorReviewResource::collection($product->vendor->reviews),
            'categories' => CategoryIndexResource::collection($this->whenLoaded('categories')),
            //merge variants for configurable product
            $this->mergeWhen($product->getTypeInstance()->isComposite(), [
                'variants'           => Self::collection($this->variants),
            ]),
            //merge for bundle product
            $this->mergeWhen($product->getTypeInstance()->isBundle(), [
                'bundle_products'           => Self::collection($this->bundle_products),
            ]),
            //eagerload address to less 3 sql
            'stocks' => ProductStockResource::collection($this->stocks->groupBy('address.postal_code'))
            //ProductStockResource::collection($this->stocks->groupBy('address.postal_code'))
        ]);
    }
}
