<?php

namespace App\Models\Vendor;

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
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
    /**
     * Get the vendor reviews.
     */

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function reviews()
    {
        return $this->hasMany(VendorReview::class, 'vendor_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
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
