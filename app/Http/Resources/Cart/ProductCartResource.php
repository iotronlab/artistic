<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Money;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductStockResource;

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
        $stocks = $this->stocks->groupBy('address.postal_code');
        return [
            'product' => new ProductIndexResource($this),
            'stocks' => $stocks,
            // ProductStockResource::collection($stocks),
            'weight' => $this->flat->weight,
            'quantity' => $this->pivot->quantity,
            'total' => $this->getTotal()->formatted(),
        ];
    }
    protected function getTotal()
    {
        return  new  Money($this->pivot->quantity * $this->flat->price->amount());
    }
}
