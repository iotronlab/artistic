<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Money;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;

class ProductCartResource extends JsonResource
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
            'product' => new ProductIndexResource($this),
            'quantity' => $this->pivot->quantity,
            'total' => $this->getTotal()->formatted(),
        ];
    }
    protected function getTotal()
    {
        return  new  Money($this->pivot->quantity * $this->flat->price->amount());
    }
}
