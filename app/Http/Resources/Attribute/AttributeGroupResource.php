<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeGroupResource extends JsonResource
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
            'id'          => $this->id,
            'code'        => $this->code,
            'name'        => $this->name,
            'attributes'  => AttributeResource::collection($this->custom_attributes)
        ];
    }
}
