<?php

namespace App\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorIndexResource extends JsonResource
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

            'id'       => $this->id,
            'name'     => $this->name,

            'slug'    => $this->slug,
            'description' => $this->description,

            'pincode'  => $this->pincode,
            'country' => $this->country
        ];
    }
}
