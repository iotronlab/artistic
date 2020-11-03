<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'attribute_family_id',
        'sku',
        'parent_id',
    ];

    protected $typeInstance;

    protected $table = 'products';

    public function getRouteKeyName()
    {
        return 'sku';
    }

    /**
     * Get the product attribute family that owns the product.
     */


    public function attribute_family()
    {
        return $this->belongsTo('App\Models\Attribute\AttributeFamily');
    }

    /**
     * Get the product attribute values that owns the product.
     */
    public function attribute_values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Get the product variants that owns the product.
     */
    public function variants()
    {
        return $this->hasMany('App\Models\Product\Product', 'parent_id');
    }

    /**
     * Get the product reviews that owns the product.
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * Get the product that owns the product.
     */
    public function parent()
    {
        return $this->belongsTo(static::class(), 'parent_id');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * The super attributes that belong to the product.
     */
    public function super_attributes()
    {
        return $this->belongsToMany('App\Models\Attribute\Attribute', 'product_super_attributes');
    }


    /**
     * Retrieve type instance
     *
     * @return AbstractType
     */
    public function getTypeInstance(ProductRepository $productRepository = null)
    {
        if ($this->typeInstance) {
            return $this->typeInstance;
        }
        $this->typeInstance = app(config('product_types.' . $this->type . '.class'));
        $this->typeInstance->setProduct($this);

        return $this->typeInstance;
    }

    /**
     * Return the product id attribute.
     */
    public function getProductIdAttribute()
    {
        return $this->id;
    }

    /**
     * Return the product attribute.
     */
    public function getProductAttribute()
    {
        return $this;
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    /**
     * The inventories that belong to the product.
     */
    public function inventories()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function ordered_inventories()
    {
        return $this->hasMany(ProductOrdered::class, 'product_id');
    }
    /**
     * @param string $key
     *
     * @return bool
     */
    public function isSaleable()
    {
        return $this->getTypeInstance()->isSaleable();
    }

    /**
     * @return integer
     */
    public function stockCount()
    {
        return $this->getTypeInstance()->totalQuantity();
    }
    public function stock()
    {
        return $this->belongsToMany(
            Product::class,
            'stocks'
        );
    }
    public function flat()
    {
        return $this->hasOne(ProductFlat::class);
    }
    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }
    
}
