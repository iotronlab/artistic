<?php

namespace App\Models\Product;

use App\Models\Attribute\AttributeFamily;
use App\Models\Attribute\AttributeOption;
use App\Models\Category\Category;
use App\Models\Collections\ProductCollection;
use App\Models\Customer\Customer;
use App\Models\Traits\CanBeScoped;
use App\Models\Vendor\Vendor;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, CanBeScoped;
    protected $fillable = [
        'type',
        'attribute_family_id',
        'sku',
        'parent_id',
        'vendor_id'
    ];

    // protected $appends = ['in_stock'];

    protected $typeInstance;

    protected $table = 'products';

    public function getRouteKeyName()
    {
        return 'sku';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInStock($query)
    {
        return;
    }

    /**
     * Get the product attribute family that owns the product.
     */


    public function attribute_family()
    {
        return $this->belongsTo(AttributeFamily::class);
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
        return $this->hasMany(Product::class, 'parent_id');
    }

    /**
     * Get the product that owns the product.
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->withPivot('base_category');
    }
    // public function baseCategory()
    // {
    //     return $this->belongsToMany(Category::class, 'product_categories')->wherePivot('base_category', 1);
    // }
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
    public function getTypeInstance()
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
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    /**
     * The inventories that belong to the product.
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function ordered_stocks()
    {
        return $this->hasMany(ProductOrdered::class, 'product_id');
    }
    /**
     * @param string $key
     *
     * @return bool
     */
    //returns if product is in stock data
    public function isSaleable()
    {
        return $this->getTypeInstance()->isSaleable();
    }
    // public function getInStockAttribute()
    // {
    //     return $this->isSaleable();
    // }

    /**
     * @return integer
     */
    //returns total quantity
    public function stockCount()
    {
        return $this->getTypeInstance()->totalQuantity();
    }
    //cart function
    public function stock()
    {
        return $this->belongsToMany(
            Product::class,
            'stocks'
        )->withPivot('quantity');
    }

    public function flat()
    {
        return $this->hasOne(ProductFlat::class);
    }
    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }
    /**
     * The images that belong to the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    /**
     * Get the value of the attribute option.
     */
    public function option($id)
    {
        $option_value = AttributeOption::where('id', $id)->first();
        return $option_value->admin_name;
    }
    /**
     * Get the bundle options that owns the product.
     */
    public function bundle_options()
    {
        return $this->hasMany(ProductBundle::class);
    }
    /**
     * The product that belong to the bundle.
     */
    public function bundle_products()
    {
        return $this->hasManyThrough(
            'App\Models\Product\Product',
            'App\Models\Product\ProductBundle',
            'product_bundle_id', // Foreign key on bundle table...
            'id', // Foreign key on products table...
            'id', // Local key on products table...
            'product_id' // Local key on bundle table...
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
    public function wishlist()
    {
        return $this->belongsToMany(Customer::class, 'customer_wishlist');
    }
    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }
}
