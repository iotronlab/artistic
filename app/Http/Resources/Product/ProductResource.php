<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Product\Product;
use App\Models\Product\ProductFlat;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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


        return [
            'product_id'             => $product->id,
            'type'                   => $product->type,
            'name'                   => $this->flat->name,
            'price'                  => $this->flat->formattedPrice,
            'short_description'      => $this->flat->short_description,
            'sku'                    => $this->flat->sku,
            'color'                  => $this->flat->color,
            'size'                   => $this->flat->size,
            'color_label'            => $this->flat->color_label,
            'size_label'             => $this->flat->size_label,
            'in_stock'               => $product->isSaleable(),
            'stock'                  => $product->stockCount(),
            //'images'                 => ProductImageResource::collection($product->images),

            'variants'               => Self::collection($this->variants)
            //For configurable attributes merge super attributes
            // $this->mergeWhen($this->getTypeInstance()->isComposite(), [
            //     'super_attributes' => AttributeResource::collection($product->super_attributes),
            // ]),
        ];
    }
}
