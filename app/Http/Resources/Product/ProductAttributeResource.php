<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'attribute_id'             => $this->attribute_id,
            'value' => $this->attribute->type == 'price' ? $this->float_value : $this->integer_value
        ];
    }
}
