<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Money;
use App\Http\Resources\Address\VendorAddressResource;
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
    public function __construct($resource)
    {
        $this->productHelper = app('App\Helpers\ProductHelper');
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        $stock_address = $this->productHelper->getPriorityStockAddress($this->whenLoaded('stock_addresses'));
        return [
            'id' => $this->id,
            'product' => new ProductIndexResource($this),
            'pickup_address' => new VendorAddressResource($stock_address),
            // ProductStockResource::collection($stocks),
            'weight' => $this->flat->weight * $this->pivot->quantity,
            //quantity from cart_user
            'quantity' => $this->pivot->quantity,
            'courier_id' => $this->pivot->courier_id,
            'courier_name' => $this->pivot->courier_name,
            'shipping_rate' => $this->pivot->shipping_rate,
            'total' => $this->getTotal()->formatted(),
        ];
    }
    protected function getTotal()
    {
        return  new  Money($this->pivot->quantity * $this->flat->price->amount());
    }
}
