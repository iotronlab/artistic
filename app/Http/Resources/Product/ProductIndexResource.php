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
        $this->productHelper = app('App\Helpers\ProductHelper');
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
            'id'             => $product->id,
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

            'vendor'                 => new VendorIndexResource($this->whenLoaded('vendor')),
            'featured'               => $this->flat->featured,
            'views'                  => $this->view_count,
            'base_image'             => $this->productHelper->getProductBaseImage($product),
            'images'             => $this->images,
            'base_category' =>   $this->productHelper->getProductBaseCategory($this->whenLoaded('categories')),
            'updated_at'             => $this->updated_at->toDayDateTimeString(),
            'created_at'             => $this->created_at->format('Y-m-d'),
            //'in_stock' => $this->in_stock,
        ];
    }
}
