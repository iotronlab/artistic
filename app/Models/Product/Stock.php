<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'stocks';
    protected $fillable = [
        'qunatity',
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
