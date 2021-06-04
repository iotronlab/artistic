<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class ProductSortScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        if($value == 'popularity')
        {
            return $builder->orderBy('view_count', 'desc');
        }
        else
        if($value == 'latest')
        {
            return $builder->latest();
        }
        else
        if($value == 'lowprice')
        {
            // return $builder->whereHas('flat', function ($builder) {
            //     $builder->orderBy('price', 'asc');
            // });
            return $builder->join('product_flat', 'product_flat.product_id', '=', 'products.id')
                            ->orderBy('product_flat.price')
                            ->select('products.*') ;
        }
        else
        if($value == 'highprice')
        {
            // return $builder->with('flat')->whereHas('flat')->get()->sortBy('flat.price');
            return $builder->join('product_flat', 'product_flat.product_id', '=', 'products.id')
                            ->orderByDesc('product_flat.price')
                            ->select('products.*') ;
        }
    }
}
