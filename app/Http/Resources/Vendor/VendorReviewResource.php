<?php

namespace App\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorReviewResource extends JsonResource
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
            'id'         => $this->id,
            'rating'     => number_format($this->rating, 1, '.', ''),
            'comment'    => $this->comment,
            //'customer'   => $this->when($this->customer_id, new CustomerResource($this->customer)),
        ];
    }
}
