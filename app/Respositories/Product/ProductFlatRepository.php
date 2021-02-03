<?php

namespace App\Repositories\Product;

use App\Models\Category\Category;
use App\Models\Product\ProductFlat;
use App\Models\Traits\CanBeScoped;
use App\Repositories\Eloquent\Repository;

class ProductFlatRepository extends Repository
{
    use CanBeScoped;
    public function model()
    {
        return ProductFlat::class;
    }

    public function update(array $data, $id)
    {
        $prod_flat = ProductFlat::where('product_id', $id);
        $prod_flat->update($data);
        return $prod_flat;
    }

    /**
     * Maximum Price of Category Product
     *
     * @return float
     */
    public function getCategoryProductMaximumPrice($category = null)
    {
        $category = Category::where('url', $category)->first();
        if (!$category) {
            return $this->model->max('price');
        }

        return $this->model
            ->leftJoin('product_categories', 'product_flat.product_id', 'product_categories.product_id')
            ->where('product_categories.category_id', $category->id)
            ->max('price');
    }
    /**
     * get Category Product Attribute
     *
     * @param  int  $categoryId
     * @return array
     */
    public function getCategoryProductAttribute($categoryId)
    {

        $qb = $this->model
            ->leftJoin('product_categories', 'product_flat.product_id', 'product_categories.product_id')
            ->where('product_categories.category_id', $categoryId);

        $productArrributes = $qb->leftJoin('product_attribute_values as pa', 'product_flat.product_id', 'pa.product_id')
            ->pluck('pa.attribute_id')
            ->toArray();

        $productSuperArrributes = $qb->leftJoin('product_super_attributes as ps', 'product_flat.product_id', 'ps.product_id')
            ->pluck('ps.attribute_id')
            ->toArray();

        $productCategoryArrributes = array_unique(array_merge($productArrributes, $productSuperArrributes));

        return $productCategoryArrributes;
    }

    /**
     * get Filterable Attributes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFilterableAttributes($category)
    {
        $category = Category::where('url', $category)->first();
        $filterAttributes = [];

        if (count($category->filterableAttributes) > 0) {
            $filterAttributes = $category->filterableAttributes;
        } else {
            $categoryProductAttributes = $this->getCategoryProductAttribute($category->id);

            if ($categoryProductAttributes) {
                foreach (app('App\Repositories\Attribute\AttributeRepository')->getFilterAttributes() as $filterAttribute) {
                    if (in_array($filterAttribute->id, $categoryProductAttributes)) {
                        $filterAttributes[] = $filterAttribute;
                    } else  if ($filterAttribute['code'] == 'price') {
                        $filterAttributes[] = $filterAttribute;
                    }
                }

                $filterAttributes = collect($filterAttributes);
            }
        }

        return $filterAttributes;
    }
}
