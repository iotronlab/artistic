<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Attribute\AttributeResource;
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
        $product = $this->product ? $this->product : $this;


        return [
            'product_id'             => $product->id,
            // 'type'                   => $product->type,
            'name'                   => $this->name,
            'price'                  => $this->formattedPrice,
            'short_description'      => $this->short_description,
            'sku'                    => $this->sku,
            'color'                  => $this->color,
            'size'                   => $this->size,
            'color_label'            => $this->color_label,
            'size_label'             => $this->size_label,
            // 'in_stock'               => $product->isSaleable(),
            // 'stock'                  => $product->stockCount(),
            //'images'                 => ProductImageResource::collection($product->images),
            'variants'               => Self::collection($this->variants),
            //For configurable attributes merge super attributes
            // $this->mergeWhen($this->getTypeInstance()->isComposite(), [
            //     'super_attributes' => AttributeResource::collection($product->super_attributes),
            // ]),
        ];
    }
}
