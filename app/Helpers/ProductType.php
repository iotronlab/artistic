<?php

namespace App\Helpers;

use App\Repositories\Product\ProductRepository;

class ProductType
{
    /**
     * Checks if a ProductType may have variants
     */
    public $productRepository;
    public static function hasVariants(string $typeKey, ProductRepository $productRepository): bool
    {
        $type = app(config('product_types.' . $typeKey . '.class'));
        return $type->hasVariants();
    }
}
