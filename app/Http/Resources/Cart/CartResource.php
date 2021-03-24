<?php

namespace App\Http\Resources\Cart;

use App\Cart\Money;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Catalog\Product as ProductResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->cart);
        return [
            'products' => ProductCartResource::collection($this->cart),

            //!n+1 from customer cart pivot qnty
            'quantity' => $this->cart->sum('pivot.quantity'),
            //'total' => $this->getTotal()->formatted(),
        ];
    }
}
