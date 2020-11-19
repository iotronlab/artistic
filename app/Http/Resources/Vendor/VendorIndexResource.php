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
        $vendor = $this->vendor ? $this->vendor : $this;
        return [

            'id'          => $vendor->id,
            'name'        => $vendor->display_name,
            'slug'        => $vendor->slug,
            'rating'      => $vendor->rating,
            'popularity'  => $vendor->popularity
        ];
    }
}
