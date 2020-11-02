<?php

namespace App\Scoping;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Scoping\Contracts\Scope;
use App\Scoping\Scopes\AttributeScope;
use Illuminate\Database\Eloquent\Builder;

class Scoper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, array $scopes)
    {
        if (isset($scopes['attribute'])) {
            $scopes = new AttributeScope();
            $scopes->apply($builder, request()->input());
        } else {
            foreach ($this->limitScopes($scopes) as $key => $scope) {
                if (!$scope instanceof Scope) {
                    continue;
                }
                $scope->apply($builder, $this->request->get($key));
            }
        }

        return $builder;
    }

    protected function limitScopes(array $scopes)
    {
        return Arr::only(
            $scopes,
            array_keys($this->request->all())
        );
    }
}
