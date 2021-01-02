<?php

namespace App\Models\CatalogRule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogRuleProductPrice extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'price',
        'catalog_rule_id',
        'product_id',
    ];
}
