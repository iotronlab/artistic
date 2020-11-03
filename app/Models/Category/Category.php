<?php

namespace App\Models\Category;

use App\Models\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasChildren;

class Category extends Model
{
    use HasFactory, HasChildren;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',

    ];
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
    /**
     * The filterable attributes that belong to the category.
     */
    public function filterableAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_filterable_attributes')->with('options');
    }
}
