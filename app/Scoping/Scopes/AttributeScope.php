<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class AttributeScope implements Scope
{
    public function apply(Builder $query, $params)
    {
        if (isset($params['new'])) {
            $query->where('new', $params['new']);
        }
        if (isset($params['featured'])) {
            $query->where('featured', $params['featured']);
        }
        if (isset($params['color'])) {
            $temp = explode(',', $params['color']);
            $query->whereIn('color', $temp);
        }
        if (isset($params['size'])) {
            $temp = explode(',', $params['size']);
            $query->whereIn('size', $temp);
        }
        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }
        // if (!isset($params['visible_individually'])) {
        //     $query->where('visible_individually', 1);
        // } else {
        //     $query->where('visible_individually', $params['visible_individually']);
        // }

        if (isset($params['search'])) {
            $query->where('product_flat.name', 'like', '%' . urldecode($params['search']) . '%');
        }
        if (isset($params['slug'])) {
            $query->where('product_flat.sku', 'like', '%' . urldecode($params['slug']) . '%');
        }
        return $query;
    }
}
