<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeFamilyResource extends AttributeFamilyIndex
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [

            'groups' => AttributeGroupResource::collection($this->attribute_groups),

        ]);
    }
}
