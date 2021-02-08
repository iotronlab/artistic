<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ProductImage
{
    /**
     * Get product's base image
     * @return array
     */
    public function getProductBaseImage($product)
    {
        $images = $product ? $product->images : null;

        if ($images && $images->count()) {
            $image = $images[0]->url;
        } else {
            //default image if image not found
            $image = null;
        }

        return $image;
    }

    public function getProductBaseCategory($categories)
    {
        // $images = $product ? $product->images : null;
        $baseCategory = null;
        foreach ($categories as $key => $category) {
            // $parent = $categories->where('parent_id', $category->id);
            if ($category->pivot->base_category == true) {
                $baseCategory = $category;
            } else {
                $baseCategory = null;
            }
        }
        return $baseCategory;
    }
}
