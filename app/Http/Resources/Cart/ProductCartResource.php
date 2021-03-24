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
            'product' => new ProductIndexResource($this),
            'addresses' => new VendorAddressResource($stock_address),
            // ProductStockResource::collection($stocks),
            'weight' => $this->flat->weight,
            //quantity from cart_user
            'quantity' => $this->pivot->quantity,
            'total' => $this->getTotal()->formatted(),
        ];
    }
    protected function getTotal()
    {
        return  new  Money($this->pivot->quantity * $this->flat->price->amount());
    }
}
