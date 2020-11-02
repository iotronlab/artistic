<?php

namespace App\Repositories\Product;

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
}
