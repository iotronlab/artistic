<?php

namespace App\Models\Vendor;

use App\Models\Category\Category;
use App\Models\Customer\Customer;
use App\Models\Product\Product;

use App\Models\Vendor\VendorReview;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use \Orchid\Screen\AsSource;


class Vendor extends Authenticatable
{
    use

        HasFactory,
        HasApiTokens,
        Notifiable,

        AsSource,
        Attachable,
        Filterable;

    protected $fillable = [
        'display_name',
        'contact_name',
        'url',
        'email',
        'password',
        'contact',
        'bio',
        'status',
        'sponsored',
        'is_freelance',
        'is_commisioned',
        'auto_approve'

    ];

    protected $allowedFilters = [
        'display_name',
        'contact_name',
        'url',
        'email',
        'contact',
        'status',
        'sponsored',
        'is_freelance',
        'is_commisioned',
        'auto_approve',
        'created_at',
        'updated_at',
    ];

    protected $allowedSorts = [
        'display_name',
        'contact_name',
        'url',
        'email',
        'status',
        'sponsored',
        'is_freelance',
        'is_commisioned',
        'auto_approve',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    public static function boot()
    {

        parent::boot();
        //For update & create functions
        static::saving(function ($vendor) {

            if ($vendor->password) {
                $vendor->password = bcrypt($vendor->password);
            }
        });
    }
    /**
     * Get the vendor reviews.
     */

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function reviews()
    {
        return $this->hasMany(VendorReview::class, 'vendor_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'vendor_categories')->withPivot('base_category');
    }

    public function subscribers()
    {
        return $this->hasMany(Customer::class, 'customer_subscription');
    }
    public function addresses()
    {
        return $this->hasMany(VendorAddress::class);
    }
}
