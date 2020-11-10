<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrdered extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'product_orders';
    protected $fillable = [
        'quantity',
        'product_id',
    ];
    /**
     * Get the product that owns the product inventory.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
