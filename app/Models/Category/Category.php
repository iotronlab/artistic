<?php

namespace App\Models\Category;

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
}
