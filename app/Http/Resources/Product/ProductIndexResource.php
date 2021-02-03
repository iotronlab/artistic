<?php

namespace App\Http\Resources\Product;

use App\Helpers\Money;
use App\Http\Resources\Vendor\VendorIndexResource;
use Illuminate\Database\Eloquent\Collection;
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
        if ($this->resource instanceof Collection) {
            return ProductIndexResource::collection($this->resource);
        }
        $product = $this->product ? $this->product : $this->flat;
        return [
            'product_id'             => $product->id,
            'type'                   => $product->type,
            'popularity'             => $product->popularity,
            'name'                   => $this->flat->name,
            'price'                  => $this->flat->rawPrice,
            'formatted_price'        => $this->flat->formattedPrice,
            'special_price'          => $this->flat->rawSpecialPrice,
            'formatted_special_price'          => $this->flat->formattedSpecialPrice,
            'sku'                    => $product->sku,
            'url_key'                => $product->url_key,
            'in_stock'               => $product->isSaleable(),
            'base_image'             => $this->productImageHelper->getProductBaseImage($product),
            'vendor'                 => new VendorIndexResource($this->vendor),
            'featured'               => $this->flat->featured,
            'views'                  => $this->view_count,

            'base_category' =>   $this->productImageHelper->getProductBaseCategory($this->whenLoaded('categories')),
            //'stock' => $this->in_stock,
        ];
    }
}
