<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'contact' => $this->contact,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,

            'landmark' => $this->landmark,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'state' => $this->state,
            'country_id' => $this->country_id,
            'country_code' => $this->country_code,
            'default' => $this->default
        ];
    }
}
