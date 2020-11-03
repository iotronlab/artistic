<?php

namespace App\Helpers;

use App\Models\Product\ProductFlat;

class ConfigurableOption
{

    /**
     * Returns the allowed variants
     * @return array
     */
    public function getAllowedProducts($product)
    {
        static $variants = [];

        if (count($variants)) {
            return $variants;
        }


        foreach ($product->variants as $variant) {
            //if ($variant->isSaleable()) {
            $variants[] = $variant;
            //}
        }
        return $variants;
    }

    /**
     * Returns the allowed variants JSON
     * @return array
     */
    public function getConfigurationConfig($product)
    {
        $options = $this->getOptions($product, $this->getAllowedProducts($product));

        $config = [
            'attributes'     => $this->getAttributesData($product, $options),

        ];

        return $config;
    }

    /**
     * Get allowed attributes
     * @return \Illuminate\Support\Collection
     */
    public function getAllowAttributes($product)
    {
        return $product->product->super_attributes;
    }

    /**
     * Get Configurable Product Options
     * @param  array  $allowedProducts
     * @return array
     */
    public function getOptions($currentProduct, $allowedProducts)
    {
        $options = [];

        $allowAttributes = $this->getAllowAttributes($currentProduct);

        foreach ($allowedProducts as $product) {
            if ($product instanceof ProductFlat) {
                $productId = $product->product_id;
            } else {
                $productId = $product->sku;
            }

            foreach ($allowAttributes as $productAttribute) {
                $productAttributeId = $productAttribute->id;
                $attributeValue = $product->flat->{$productAttribute->code};

                $options[$productAttributeId][$attributeValue][] = $productId;

                $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }
        return $options;
    }

    /**
     * Get product attributes
     *
     * @param  \Webkul\Product\Contracts\Product|\Webkul\Product\Contracts\ProductFlat  $product
     * @param  array  $options
     * @return array
     */
    public function getAttributesData($product, array $options = [])
    {
        $attributes = [];

        $allowAttributes = $this->getAllowAttributes($product);

        foreach ($allowAttributes as $attribute) {

            $attributeOptionsData = $this->getAttributeOptionsData($attribute, $options);

            if ($attributeOptionsData) {
                $attributeId = $attribute->id;

                $attributes[] = [
                    'id'          => $attributeId,
                    'code'        => $attribute->code,
                    'label'       => $attribute->name ? $attribute->name : $attribute->admin_name,
                    'options'     => $attributeOptionsData,
                ];
            }
        }

        return $attributes;
    }

    /**
     * @param  array  $options
     * @return array
     */
    protected function getAttributeOptionsData($attribute, $options)
    {
        $attributeOptionsData = [];
        foreach ($attribute->options as $attributeOption) {

            $optionId = $attributeOption->id;
            if (isset($options[$attribute->id][$optionId])) {
                $attributeOptionsData[] = [
                    'id'           => $optionId,
                    'label'        => $attributeOption->label ? $attributeOption->label : $attributeOption->admin_name,
                    'products'     => $options[$attribute->id][$optionId],
                ];
            }
        }
        return $attributeOptionsData;
    }
}
