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
            'display_name'        => $vendor->display_name,
            'contact_name'        => $vendor->display_name,
            // 'email'        => $vendor->display_name,

            'url'        => $vendor->url,
            'rating'      => $vendor->rating,
            'popularity'  => $vendor->popularity,
            'avatar'      => $vendor->avatarimg,
            'cover'      => $vendor->coverimg,
            'views'      => $vendor->view_count
        ];
    }
}
