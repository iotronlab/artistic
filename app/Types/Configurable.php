<?php

namespace App\Types;

use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeOption;
use App\Models\Product\Product;
use App\Models\Product\ProductAttributeValue;
use App\Models\Product\ProductFlat;
use Illuminate\Support\Str;
use Illuminate\Container\Container as App;
use Illuminate\Support\Arr;

class Configurable extends AbstractType
{
    /**
     * Skip attribute for downloadable product type
     *
     * @var array
     */
    protected $skipAttributes = ['price', 'special_price', 'width', 'height', 'depth', 'weight'];

    /**
     * Is a composite product type
     *
     * @var boolean
     */
    protected $isComposite = true;

    /**
     * Has child products aka variants
     *
     * @var boolean
     */
    protected $hasVariants = true;
    public App $app;
    /**
     * product options
     */
    protected $productOptions = [];

    //To convert variants into array of permutations
    function array_permutation($input)
    {
        $results = [];

        foreach ($input as $key => $values) {
            if (empty($values)) {
                continue;
            }

            if (empty($results)) {
                foreach ($values as $value) {
                    $results[] = [$key => $value];
                }
            } else {
                $append = [];

                foreach ($results as &$result) {
                    $result[$key] = array_shift($values);

                    $copy = $result;

                    foreach ($values as $item) {
                        $copy[$key] = $item;
                        $append[] = $copy;
                    }

                    array_unshift($values, $result[$key]);
                }

                $results = array_merge($results, $append);
            }
        }

        return $results;
    }

    public function create(array $data)
    {
        $product = $this->productRepository->getModel()->create($data);
        $product_flat = ProductFlat::create([
            'sku' => $data['sku'],
            'product_id' => $product->id
        ]);
        $product_flat->save();
        $flat_parent_id = $product_flat->id;

        if (isset($data['super_attributes'])) {
            $super_attributes = [];
            foreach ($data['super_attributes'] as $attributeCode => $attributeOptions) {
                $attribute = Attribute::where('code', $attributeCode)->pluck('id')->first();
                $attribute_id = $attribute;
                $super_attributes[$attribute_id] = $attributeOptions;

                //Adds attribute_id to Super attributes table
                $product->super_attributes()->attach($attribute_id);
            }
            foreach ($this->array_permutation($super_attributes) as $permutation) {
                $this->createVariant($product, $flat_parent_id, $permutation);
            }
        }
        return $product;
    }

    public function update(array $data, $id, $attribute = "id")
    {
        $product = parent::update($data, $id, $attribute);

        //$previousVariantIds = $product->variants->pluck('id');
        if (isset($data['variants'])) {
            foreach ($data['variants'] as $variantId => $variantData) {
                $this->updateVariant($variantData, $variantId);
            }
        }
        return $product;
    }

    public function createVariant($product, $flat_id, $permutation, $data = [])
    {
        //dD($permutation);
        if (!count($data)) {
            $data = [
                'sku'         => $product->sku . '-variant-' . implode('-', $permutation),
                'name'        => '',
                'inventories' => [],
                'price'       => 0,
                'weight'      => 0,
                'status'      => 1,
            ];
        }
        $typeOfVariants = 'simple';
        //create variant in product table
        $variant = Product::create([
            'parent_id'           => $product->id,
            'type'                => $typeOfVariants,
            'attribute_family_id' => $product->attribute_family_id,
            'sku'                 => $data['sku'],
        ]);


        // //inserting value in Product Attribute value with basic array values
        // foreach (['sku', 'name', 'price', 'weight', 'status'] as $attributeCode) {
        //     $attribute = Attribute::where('code', $attributeCode)->pluck('id')->first();
        //     $attribute_id = $attribute;
        //     $this->attributeValueRepository->create([
        //         'product_id'   => $variant->id,
        //         'attribute_id' => $attribute_id,
        //         'value'        => $data[$attributeCode],
        //     ]);
        // }

        //create same product variant with null values in Product Flat table 
        $variant_flat = ProductFlat::create([
            'sku'               =>   $data['sku'],
            'product_id'        =>   $variant->id,
            'parent_id'         =>   $flat_id
        ]);
        $variant_flat->save();
        //inserting value in Product Attribute value with the attributeId
        foreach ($permutation as $attributeId => $optionId) {
            $this->attributeValueRepository->create([
                'product_id'    => $variant->id,
                'attribute_id'  => $attributeId,
                'value' => $optionId,
            ]);

            $att_value = AttributeOption::where('id', $optionId)->pluck('admin_name')->first();
            $att_name = Attribute::where('id', $attributeId)->pluck('code')->first();
            //create same product variant with null values in Product Flat table 
            ProductFlat::where('id', $variant_flat->id)->update([
                $att_name . '_label' =>  $att_value,
                $att_name         =>  $optionId,
            ]);
        }
        return $variant;
    }

    public function updateVariant(array $data, $id)
    {
        $variant = $this->productRepository->find($id);
        //to update in product flat
        $prod_flat = $this->productFlatRepository->update($data, $id);
        return $variant;
    }

    /**
     * Returns children ids
     *
     * @return array
     */
    public function getChildrenIds()
    {
        return $this->product->variants()->pluck('id')->toArray();
    }


    /**
     * Returns validation rules
     *
     * @return array
     */
    public function getTypeValidationRules()
    {
        return [
            'variants.*.name'   => 'required',
            'variants.*.sku'    => 'required',
            'variants.*.price'  => 'required',
            'variants.*.weight' => 'required',
        ];
    }

    /**
     * Returns additional information for items
     *
     * @param  array  $data
     * @return array
     */
    public function getAdditionalOptions($data)
    {
        $childProduct = app('App\Repositories\Product\ProductRepository')->findOneByField('id', $data['selected_configurable_option']);

        foreach ($this->product->super_attributes as $attribute) {
            $option = $attribute->options()->where('id', $childProduct->{$attribute->code})->first();

            $data['attributes'][$attribute->code] = [
                'attribute_name' => $attribute->name ?  $attribute->name : $attribute->admin_name,
                'option_id'      => $option->id,
                'option_label'   => $option->label ? $option->label : $option->admin_name,
            ];
        }

        return $data;
    }

    /**
     * @param  int  $qty
     * @return bool
     */
    public function haveSufficientQuantity()
    {
        $variants_stock = 0;
        foreach ($this->product->variants as $variant) {
            if ($variant->haveSufficientQuantity() > 0) {
                $variants_stock += $variant->haveSufficientQuantity();
            }
        }

        return $variants_stock;
    }

    /**
     * Return true if this product type is saleable
     *
     * @return bool
     */
    public function isSaleable()
    {
        foreach ($this->product->variants as $variant) {
            if ($variant->isSaleable()) {
                return true;
            }
        }

        return false;
    }
}
