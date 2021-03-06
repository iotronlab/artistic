<?php

namespace App\Helpers\CatalogRule;

use App\Helpers\Validator;
use App\Models\Product\ProductAttributeValue;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\CatalogRule\CatalogRuleProductRepository;
use App\Repositories\Product\ProductRepository;
use Carbon\Carbon;

class CatalogRuleProduct
{
    // protected $catalogRuleProductRepository;
    // protected $productRepository;
    // protected $validator;
    // protected $attributeRepository;

    // public function __construct(
    //     AttributeRepository $attributeRepository,
    //     ProductRepository $productRepository,
    //     CatalogRuleProductRepository $catalogRuleProductRepository,
    //     Validator $validator
    // ) {
    //     $this->attributeRepository = $attributeRepository;

    //     $this->productRepository = $productRepository;

    //     $this->catalogRuleProductRepository = $catalogRuleProductRepository;

    //     $this->validator = $validator;
    // }
    // /**
    //  * Collect discount on cart
    //  *
    //  * @return void
    //  */
    // public function insertRuleProduct($rule, $batchCount = 1000, $product = null)
    // {
    //     if (!(float) $rule->discount_amount)
    //         return;

    //     $productIds = $this->getMatchingProductIds($rule, $product);

    //     $rows = [];

    //     $startsFrom = $rule->starts_from ? Carbon::createFromTimeString($rule->starts_from . " 00:00:01") : null;

    //     $endsTill = $rule->ends_till ? Carbon::createFromTimeString($rule->ends_till . " 23:59:59") : null;

    //     foreach ($productIds as $productId) {
    //         foreach ($rule->customer_groups()->pluck('id') as $customerGroupId) {
    //             $rows[] = [
    //                 'starts_from'       => $startsFrom,
    //                 'ends_till'         => $endsTill,
    //                 'catalog_rule_id'   => $rule->id,
    //                 'customer_group_id' => $customerGroupId,
    //                 'product_id'        => $productId,
    //                 'discount_amount'   => $rule->discount_amount,
    //                 'action_type'       => $rule->action_type,
    //                 'end_other_rules'   => $rule->end_other_rules,
    //                 'sort_order'        => $rule->sort_order,
    //             ];

    //             if (count($rows) == $batchCount) {
    //                 $this->catalogRuleProductRepository->getModel()->insert($rows);

    //                 $rows = [];
    //             }
    //         }
    //     }

    //     if (!empty($rows)) {
    //         $this->catalogRuleProductRepository->getModel()->insert($rows);
    //     }
    // }

    // /**
    //  * Get array of product ids which are matched by rule
    //  *
    //  * @return array
    //  */
    // public function getMatchingProductIds($rule, $product = null)
    // {
    //     $qb = app(ProductRepository::class)->scopeQuery(function ($query) use ($rule, $product) {
    //         $qb = $query->distinct()
    //             ->addSelect('products.*')
    //             ->leftJoin('product_flat', 'products.id', '=', 'product_flat.product_id');

    //         if ($product) {
    //             $qb->where('products.id', $product->id);
    //         }

    //         if (!$rule->conditions) {
    //             return $qb;
    //         }

    //         $appliedAttributes = [];

    //         foreach ($rule->conditions as $condition) {
    //             if (
    //                 !$condition['attribute']
    //                 || !isset($condition['value'])
    //                 || is_null($condition['value'])
    //                 || $condition['value'] == ''
    //                 || in_array($condition['attribute'], $appliedAttributes)
    //             ) {
    //                 continue;
    //             }

    //             $appliedAttributes[] = $condition['attribute'];

    //             $chunks = explode('|', $condition['attribute']);

    //             $qb = $this->addAttributeToSelect(end($chunks), $qb);
    //         }

    //         return $qb;
    //     });

    //     $validatedProductIds = [];

    //     foreach ($qb->get() as $product) {
    //         if (!$product->getTypeInstance()->priceRuleCanBeApplied()) {
    //             continue;
    //         }

    //         if ($this->validator->validate($rule, $product)) {
    //             if ($product->getTypeInstance()->isComposite()) {
    //                 $validatedProductIds = array_merge($validatedProductIds, $product->getTypeInstance()->getChildrenIds());
    //             } else {
    //                 $validatedProductIds[] = $product->id;
    //             }
    //         }
    //     }

    //     return array_unique($validatedProductIds);
    // }

    // /**
    //  * Add product attribute condition to query
    //  *
    //  * @param  string  $attributeCode
    //  * @param \Illuminate\Database\Eloquent\Builder  $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function addAttributeToSelect($attributeCode, $query)
    // {
    //     $attribute = $this->attributeRepository->findOneByField('code', $attributeCode);

    //     if (!$attribute) {
    //         return $query;
    //     }

    //     $query = $query->leftJoin('product_attribute_values as ' . 'pav_' . $attribute->code, function ($qb) use ($attribute) {

    //         $qb->on('products.id', 'pav_' . $attribute->code . '.product_id')
    //             ->where('pav_' . $attribute->code . '.attribute_id', $attribute->id);
    //     });

    //     $query = $query->addSelect('pav_' . $attribute->code . '.' . ProductAttributeValue::$attributeTypeFields[$attribute->type] . ' as ' . $attribute->code);

    //     return $query;
    // }

    // /**
    //  * Returns catalog rule products
    //  *  $product
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function getCatalogRuleProducts($product = null)
    // {
    //     $results = $this->catalogRuleProductRepository->scopeQuery(function ($query) use ($product) {
    //         $qb = $query->distinct()
    //             ->select('catalog_rule_products.*')
    //             ->leftJoin('products', 'catalog_rule_products.product_id', '=', 'products.id')
    //             ->orderBy('customer_group_id', 'asc')
    //             ->orderBy('product_id', 'asc')
    //             ->orderBy('sort_order', 'asc')
    //             ->orderBy('catalog_rule_id', 'asc');

    //         $qb = $this->addAttributeToSelect('price', $qb);

    //         if ($product) {
    //             if (!$product->getTypeInstance()->priceRuleCanBeApplied()) {
    //                 return $qb;
    //             }

    //             if ($product->getTypeInstance()->isComposite()) {
    //                 $qb->whereIn('catalog_rule_products.product_id', $product->getTypeInstance()->getChildrenIds());
    //             } else {
    //                 $qb->where('catalog_rule_products.product_id', $product->id);
    //             }
    //         }

    //         return $qb;
    //     })->get();

    //     return $results;
    // }

    // /**
    //  * Returns catalog rules
    //  * @return void
    //  */
    // public function cleanProductIndex($productIds = [])
    // {
    //     if (count($productIds)) {
    //         $this->catalogRuleProductRepository->getModel()->whereIn('product_id', $productIds)->delete();
    //     } else {
    //         $this->catalogRuleProductRepository->getModel()->where([
    //             ['product_id', 'like', '%%']
    //         ])->delete();
    //     }
    // }
}
