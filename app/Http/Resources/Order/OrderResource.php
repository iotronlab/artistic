<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Shipping\ShippingMethodResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'subtotal' => $this->subtotal,
            'products' => ProductIndexResource::collection($this->whenLoaded('products')),
            'address' => new AddressResource($this->whenLoaded('address')),
            'shipping' => new ShippingMethodResource($this->whenLoaded('shippingMethod'))
        ];
    }
}
