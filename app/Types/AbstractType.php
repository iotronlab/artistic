<?php

namespace App\Types;

use App\Models\Product\ProductAttributeValue;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductAttributeValueRepository;
use App\Repositories\Product\ProductInventoryRepository;
use App\Models\Product\ProductFlat;
use App\Repositories\Product\ProductFlatRepository;
use Illuminate\Support\Arr;

abstract class AbstractType
{

    protected $attributeRepository;

    protected $productRepository;

    protected $attributeValueRepository;
    protected $isBundle = false;
    /**
     * ProductInventoryRepository instance
     *
     * @var ProductInventoryRepository
     */
    protected $productInventoryRepository;

    protected $productImageRepository;

    protected $productImageHelper;


    protected $product;

    /**
     * Is a composite product type
     *
     * @var bool
     */
    protected $isComposite = false;

    /**
     * Is a stokable product type
     *
     * @var bool
     */
    protected $isStockable = true;

    /**
     * Show quantity box
     *
     * @var bool
     */
    protected $showQuantityBox = false;

    /**
     * Is product have sufficient quantity
     *
     * @var bool
     */
    protected $haveSufficientQuantity = true;

    /**
     * Product can be moved from wishlist to cart or not
     *
     * @var bool
     */
    protected $canBeMovedFromWishlistToCart = true;

    /**
     * Has child products aka variants
     *
     * @var bool
     */
    protected $hasVariants = false;

    /**
     * Product children price can be calculated or not
     *
     * @var bool
     */
    protected $isChildrenCalculated = false;

    /**
     * product options
     */
    protected $productOptions = [];
    protected $productFlatRepository;


    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProductAttributeValueRepository $attributeValueRepository,
        ProductFlatRepository $productFlatRepository
    ) {
        $this->attributeRepository = $attributeRepository;

        $this->productRepository = $productRepository;

        $this->attributeValueRepository = $attributeValueRepository;

        $this->productFlatRepository = $productFlatRepository;
    }


    public function create(array $data)
    {
        $new_product = $this->productRepository->getModel()->create($data);
        $product_flat = ProductFlat::create([
            'sku' => $data['sku'],
            'product_id' => $new_product->id
        ]);
        $product_flat->save();
        return $new_product;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $product = $this->productRepository->find($id);
        //update product
        $product->update($data);

        //update attribute-value table
        foreach ($product->attribute_family->is_user_defined() as $attribute) {

            if (!isset($data[$attribute->code])) {
                continue;
            }

            $attributeValue = ProductAttributeValue::where([
                'product_id'   => $product->id,
                'attribute_id' => $attribute->id
            ])->first();

            if (!$attributeValue) {
                $this->attributeValueRepository->create([
                    'product_id'   => $product->id,
                    'attribute_id' => $attribute->id,
                    'value'        => $data[$attribute->code],
                ]);
            } else {
                $this->attributeValueRepository->update([
                    ProductAttributeValue::$attributeTypeFields[$attribute->type] => $data[$attribute->code]
                ], $attributeValue->id);
            }
        }

        //update product flat
        $inputData = Arr::except($data, ['variants']);
        $prod_flat = $this->productFlatRepository->update($inputData, $id);
        return $product;
    }


    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Returns children ids
     *
     * @return array
     */
    public function getChildrenIds()
    {
        return [];
    }


    /**
     * Return true if this product can be composite
     *
     * @return bool
     */
    public function isComposite()
    {
        return $this->isComposite;
    }

    /**
     * Return true if this product can be bundled
     *
     * @return bool
     */
    public function isBundle()
    {
        return $this->isBundle;
    }
    /**
     * Check if catalog rule can be applied
     *
     * @return bool
     */
    public function priceRuleCanBeApplied()
    {
        return true;
    }

    /**
     * Return true if this product can have variants
     *
     * @return bool
     */
    public function hasVariants()
    {
        return $this->hasVariants;
    }

    /**
     * Product children price can be calculated or not
     *
     * @return bool
     */
    public function isChildrenCalculated()
    {
        return $this->isChildrenCalculated;
    }


    /**
     * Returns validation rules
     *
     * @return array
     */
    public function getTypeValidationRules()
    {
        return [];
    }
    /**
     * Returns additional information for items
     *
     * @param  array  $data
     * @return array
     */
    public function getAdditionalOptions($data)
    {
        return $data;
    }


    //get product options
    public function getProductOptions()
    {
        return $this->productOptions;
    }

    public function totalQuantity()
    {
        $total = 0;
        foreach ($this->product->inventories as $inventory) {
            $total += $inventory->quantity;
        }
        $order = 0;
        //dd($this->product->ordered_inventories);
        foreach ($this->product->ordered_inventories as $o) {
            $order += $o->quantity;
        }
        $total -= $order;

        return $total;
    }
}
