<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'type'        => $this->type,
            'name'        => $this->name,
            'is_configurable' => $this->is_configurable,
            'options'     => AttributeOptionResource::collection($this->options),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
