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

class Vendor extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'display_name',
        'contact_name',
        'url',
        'email',
        'password',
        'contact',
        'description',
    ];

    protected $hidden = [
        'password',
    ];
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
        return $this->belongsToMany(Category::class, 'vendor_categories');
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
