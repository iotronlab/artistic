<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function __construct($resource)
    {
        $this->categoryImageHelper = app('App\Helpers\CategoryImage');
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        $children =  Self::collection($this->whenLoaded('children'));
        //$children ? $children : null;
        return [
            "id" => $this->id,
            "parent_id" => $this->parent_id,
            "meta_title" => $this->meta_title,
            "meta_keyword" => $this->meta_keywords,
            "meta_desc" => $this->meta_desc,
            "name" => $this->name,
            "image_path" => $this->categoryImageHelper->getCategoryImage($this->url),
            "url" => $this->url,
            "views" => $this->view_count,
            "children" => $children

            // example of n+1 problem
            // $this->children->isNotEmpty() ? Self::collection($this->whenLoaded('children')) : null,

        ];
    }
}
