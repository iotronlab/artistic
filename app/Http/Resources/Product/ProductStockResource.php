<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Address\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return ProductStockResource::collection($this->resource);
        }
        return [
            'id'             => $this->id,

            'quantity'                   => $this->quantity,
            'postal_code'                  => $this->address->postal_code,
            'address'                  => new AddressResource($this->address),
            'created_at'                  => $this->created_at->toDayDateTimeString(),
            'updated_at'                  => $this->updated_at->toDayDateTimeString(),


        ];
    }
    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function with($request)
    // {
    //     return [
    //         'message' => 'Success! Product stock saved.',
    //     ];
    // }
}
