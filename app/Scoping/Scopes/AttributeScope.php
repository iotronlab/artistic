<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class AttributeScope implements Scope
{
    public function apply(Builder $query, $params)
    {
        if (isset($params['category_id'])) {
            $query->where('product_categories.category_id', $params['category_id']);
        }
        if (isset($params['new'])) {
            $query->where('product_flat.new', $params['new']);
        }
        if (isset($params['featured'])) {
            $query->where('product_flat.featured', $params['featured']);
        }
        if (isset($params['color'])) {
            $temp = explode(',', $params['color']);
            $query->whereIn('product_flat.color', $temp);
        }
        if (isset($params['size'])) {
            $temp = explode(',', $params['size']);
            $query->whereIn('product_flat.size', $temp);
        }
        if (isset($params['status'])) {
            $query->where('product_flat.status', $params['status']);
        }
        if (!isset($params['visible_individually'])) {
            $query->where('product_flat.visible_individually', 1);
        } else {
            $query->where('product_flat.visible_individually', $params['visible_individually']);
        }

        if (isset($params['search'])) {
            $query->where('product_flat.name', 'like', '%' . urldecode($params['search']) . '%');
        }
        if (isset($params['slug'])) {
            $query->where('product_flat.sku', 'like', '%' . urldecode($params['slug']) . '%');
        }
        return $query;
    }
}
