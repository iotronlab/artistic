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
            $image = $images[0]->path;
        } else {
            //default image if image not found
            $image = 'default.png';
        }

        return $image;
    }
}
