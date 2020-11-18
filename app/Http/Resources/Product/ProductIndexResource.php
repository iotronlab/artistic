<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Vendor\VendorIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct($resource)
    {
        $this->productImageHelper = app('App\Helpers\ProductImage');
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->product ? $this->product : $this->flat;
        return [
            'product_id'             => $product->id,
            'type'                   => $product->type,
            'name'                   => $this->flat->name,
            'price'                  => $this->flat->formattedPrice,
            'sku'                    => $product->sku,
            'in_stock'               => $product->isSaleable(),
            'base_image'             => $this->productImageHelper->getProductBaseImage($product),
            'vendor'                 => new VendorIndexResource($this->vendor)
        ];
    }
}
