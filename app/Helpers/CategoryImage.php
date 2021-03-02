<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class CategoryImage
{
    /**
     * Get product's base image
     * @return array
     */
    public function getCategoryImage($url)
    {
        //$image = $category ? $product->images : null;
        if (Storage::disk('public')->exists('/category-images/' . $url . '.webp')) {
            $path = Storage::disk('public')->url('/category-images/' . $url . '.webp');
            // $file_url = Storage::url($path);
            $web_url = asset($path);
        }
        // $path = $image->storeAs('/profile-images/' . $vendor->url, $pic_path, 'public');
        else {
            $web_url = null;
        }
        // if ($image && $images->count()) {
        //     $image = $images[0]->path;
        // } else {
        //     //default image if image not found
        //     $image = 'default.png';
        // }

        return $web_url;
    }
}
