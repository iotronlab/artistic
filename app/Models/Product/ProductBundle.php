<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    use HasFactory;
    protected $table = 'product_bundle_option';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
