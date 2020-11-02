<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'product_categories';
    protected $fillable = [
        'category_id',
        'product_id',
    ];
    /**
     * Get the category of the product value.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product that belongs to the category.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
