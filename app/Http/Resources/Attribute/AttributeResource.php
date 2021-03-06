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
            'name'        => $this->admin_name,
            'is_configurable' => $this->is_configurable,
            'is_visible' => $this->is_visible_on_front,
            'required' => $this->is_required,
            'validation' => $this->validation,
            'options'     => AttributeOptionResource::collection($this->options),
        ];
    }
}
