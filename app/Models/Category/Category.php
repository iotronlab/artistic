<?php

namespace App\Models\Category;

use App\Models\Attribute\Attribute;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasChildren;
use App\Models\Vendor\Vendor;

class Category extends Model
{
    use HasFactory, HasChildren;
    protected $fillable = [
        'name',
        'url',
        'parent_id',

    ];

    public function getRouteKeyName()
    {
        return 'url';
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    /**
     * Get the category that owns the category.
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_categories');
    }
    /**
     * The filterable attributes that belong to the category.
     */
    public function filterableAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_filterable_attributes')->with('options');
    }

    public function trending()
    {
        return $this->orderByDesc("view_count");
    }
}
