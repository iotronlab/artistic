<?php

namespace App\Helpers;

use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Product\ProductRepository;
use App\Types\AbstractType;
use App\Types\Configurable;
use App\Types\Simple;

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
