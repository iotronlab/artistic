<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class NewScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return
            $builder->where('created_at', '>', now()->subDays(7));
    }
}
