<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class StockScope implements
    Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->append('in_stock')->where('in_stock', 'true');
    }
}
