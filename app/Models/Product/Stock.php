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
        'quantity',
        'product_id',
    ];
    /**
     * Get the product that owns the product stock.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
