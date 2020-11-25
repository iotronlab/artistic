<?php

namespace App\Types;

use App\Models\Product\ProductBundle;
use App\Models\Product\ProductFlat;

class Bundle extends AbstractType
{
    /**
     * Skip attribute for Bundle product type
     *
     * @var array
     */
    protected $skipAttributes = ['price', 'special_price', 'width', 'height', 'depth', 'weight'];
    /**
     * Is a composite product type
     *
     * @var bool
     */
    protected $isComposite = false;
    protected $isBundle = true;

    /**
     * Product children price can be calculated or not
     *
     * @var bool
     */
    protected $isChildrenCalculated = true;

    /**
     * Product Options
     */
    protected $productOptions = [];

    public function create(array $data)
    {
        $new_product = $this->productRepository->getModel()->create($data);
        $product_flat = ProductFlat::create([
            'sku' => $data['sku'],
            'product_id' => $new_product->id
        ]);
        $product_flat->save();
        $productOptions = $data['bundle_products'];
        foreach ($productOptions as $bundleOptionProduct) {
            $product_bundle = ProductBundle::create([
                'product_bundle_id' => $new_product->id,
                'product_id' => $bundleOptionProduct
            ]);
            $product_bundle->save();
        }
        return $new_product;
    }
    /**
     * Return true if this product type is saleable
     *
     * @return bool
     */
    public function isSaleable()
    {
        foreach ($this->product->bundle_options as $bundle) {
            if ($bundle->isSaleable()) {
                return true;
            }
        }

        return false;
    }
}
